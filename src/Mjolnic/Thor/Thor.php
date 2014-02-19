<?php

namespace Mjolnic\Thor;

use Route,
    Config;

class Thor {

    const VERSION = '1.0.0-dev';
    const PACKAGE = 'mjolnic/thorcms';
    const NS = 'thor';

    public static function getViewName($name) {
        return \Config::get(thor_ns().'::views.' . $name, thor_ns().'::admin.' . str_replace('_', '.', $name));
    }

    public static function setAdminResourceRoutes($singular, $namespace = '\\Mjolnic\\Thor\\') {
        Route::group(array('prefix' => Config::get(thor_ns().'::admin_route_prefix'), 'before' => 'admin-auth'), function() use($singular, $namespace) {
            $plural = \Str::plural($singular);
            $rt = \Config::get(thor_ns().'::admin_route_prefix') . '.' . $plural;
            $ctrl = $namespace . ucfirst($plural) . 'Controller';
            $model = $namespace . ucfirst($singular);

            Route::model($singular, $model);
            Route::pattern($singular, '[0-9]+');
            Route::when($singular . '*', function() use ($plural) {
                if ((\Entrust::can('access_backend') && \Entrust::can('manage_' . $plural)) == false) { // Checks the current user
                    return \Redirect::route('admin');
                }
            });

            Route::get($plural, array('as' => $rt . '.index', 'uses' => $ctrl . '@index'));
            Route::get($plural . '/create', array('as' => $rt . '.create', 'uses' => $ctrl . '@create'));
            Route::post($plural, array('as' => $rt . '.store', 'uses' => $ctrl . '@store'));
            Route::get($plural . '/{' . $singular . '}', array('as' => $rt . '.edit', 'uses' => $ctrl . '@edit'));
            Route::get($plural . '/{' . $singular . '}/show', array('as' => $rt . '.show', 'uses' => $ctrl . '@show'));
            Route::patch($plural . '/{' . $singular . '}', array('as' => $rt . '.update', 'uses' => $ctrl . '@update'));
            Route::delete($plural . '/{' . $singular . '}', array('as' => $rt . '.destroy', 'uses' => $ctrl . '@destroy'));
            Route::controller($plural, $ctrl);
        });
    }

    public static function setAccountRoutes($prefix = 'account', $ctrl = '\\Mjolnic\\Thor\\AccountController') {
        Route::group(array('prefix' => $prefix), function() use($prefix, $ctrl) {
            $prefix = $prefix ? ($prefix . '.') : '';
            Route::get('/', array('as' => $prefix . 'show', 'before' => 'auth', 'uses' => $ctrl . '@show'));
            Route::post('/', array('as' => $prefix . 'update', 'before' => 'auth', 'uses' => $ctrl . '@update'));
            Route::get('signup', array('as' => $prefix . 'create', 'uses' => $ctrl . '@create'));
            Route::post('signup', array('as' => $prefix . 'store', 'uses' => $ctrl . '@store'));
            Route::get('login', array('as' => $prefix . 'login', 'uses' => $ctrl . '@login'));
            Route::post('login', array('as' => $prefix . 'do_login', 'uses' => $ctrl . '@do_login'));
            Route::get('confirm/{code}', array('as' => $prefix . 'confirm', 'uses' => $ctrl . '@confirm'));
            Route::get('forgot_password', array('as' => $prefix . 'forgot_password', 'uses' => $ctrl . '@forgot_password'));
            Route::post('forgot_password', array('as' => $prefix . 'do_forgot_password', 'uses' => $ctrl . '@do_forgot_password'));
            Route::get('reset_password/{token}', array('as' => $prefix . 'reset_password', 'uses' => $ctrl . '@reset_password'));
            Route::post('reset_password', array('as' => $prefix . 'do_reset_password', 'uses' => $ctrl . '@do_reset_password'));
            Route::get('logout', array('as' => $prefix . 'logout', 'uses' => $ctrl . '@logout'));
        });
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public static function getGravatar($email, $s = 40, $img = true, $atts = array(), $d = 'mm', $r = 'g') {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }

}
