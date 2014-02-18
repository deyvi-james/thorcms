<?php

// Helper functions here


function locale_route($path = null) {
    return App::getLocale() . '/' . ltrim($path, '/');
}

function locale_url($path = null, $parameters = array(), $secure = null) {
    return url(locale_route($path), $parameters, $secure);
}

function admin_url($path = null, $parameters = array(), $secure = null) {
    return locale_url(Config::get('thor::admin_route_prefix') . '/' . ltrim($path, '/'), $parameters, $secure);
}

function admin_asset($path = null, $secure = null){
    return asset('packages/mjolnic/thor/'.ltrim($path, '/'), $secure);
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