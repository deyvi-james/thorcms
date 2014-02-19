<?php

namespace Mjolnic\Thor;

class Language extends Model {

    protected $guarded = array();
    public static $rules = array(
        'name' => 'required',
        'code' => 'required|unique:languages',
        'is_active' => 'required',
        'sorting' => 'required'
    );
    protected static $current;

    /**
     * 
     * @return Language|null
     */
    public static function detect() {
        $activeLangs = self::findActive();
        if (count($activeLangs) > 0) {
            \Config::set(thor_ns().'::i18n_default_locale', $activeLangs[0]->code);
            \Config::set(thor_ns().'::i18n_locales', array_pluck($activeLangs, 'code'));
            $currentCode = Locale::detect();
            foreach ($activeLangs as $ln) {
                if ($ln->code == $currentCode) {
                    self::$current = $ln;
                }
            }
        }
        return self::$current;
    }

    /**
     * 
     * @return Language|null
     */
    public static function current() {
        return self::$current;
    }

    /**
     * 
     * @return Language[]
     */
    public static function findActive() {
        return self::orderBy('sorting', 'asc')->where('is_active', '=', 1)->get();
    }

    /**
     * 
     * @return Language
     */
    public static function findByCode($code) {
        return self::whereRaw('(code=?)', array($code))->first();
    }

    /**
     * 
     * @return Language
     */
    public static function findActiveByCode($code) {
        return self::whereRaw('(is_active=1) and (code=?)', array($code))->first();
    }

}
