<?php

// Helper functions here

function locale_url($path = null, $parameters = array(), $secure = null) {
    return url(App::getLocale() . '/' . ltrim($path, '/'), $parameters, $secure);
}

function admin_route($route = null) {
    return Config::get('thor::admin_route_prefix') . '.' . ltrim($route, '.');
}

function admin_url($path = null, $parameters = array(), $secure = null) {
    return locale_url(Config::get('thor::admin_route_prefix') . '/' . ltrim($path, '/'), $parameters, $secure);
}

function admin_asset($path = null, $secure = null){
    return asset('packages/mjolnic/thorcms/'.ltrim($path, '/'), $secure);
}

function lang_code(){
    return Mjolnic\Thor\Language::current()->code;
}

function lang_id(){
    return Mjolnic\Thor\Language::current()->id;
}

/**
 * The currently authenticated user (or null)
 * @return Mjolnic\Thor\User | null
 */
function auth_user(){
    return Auth::user();
}