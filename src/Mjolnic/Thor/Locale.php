<?php

namespace Mjolnic\Thor;

class Locale {

    public static function detect() {
        $language = self::fromRouteSegment(1, false);
        if ($language === null) {
            $language = self::fromHttpHeader('HTTP_ACCEPT_LANGUAGE', false);
        }

        if ($language == false) {
            $language = \Config::get(thor_ns().'::i18n_default_locale');
            \Event::fire(thor_ns().'::invalid_locale', array($language), false);
        }
        \Config::set('app.locale', $language);
        \App::setLocale($language);

        return $language;
    }

    public static function fromHttpHeader($header = 'HTTP_ACCEPT_LANGUAGE', $default = false) {
        return substr(\Request::server($header, $default), 0, 2);
    }

    public static function fromRouteSegment($index = 1, $default = false) {
        $language = $default;
        if (null !== \Request::segment($index)) {
            $routeLanguage = \Request::segment($index);
            if (in_array($routeLanguage, \Config::get(thor_ns().'::i18n_locales'))) {
                $language = $routeLanguage;
            }
        } else {
            // empty route
            $language = null;
        }
        return $language;
    }

}
