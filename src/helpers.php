<?php

// Helper functions here


function locale_route($path = null) {
    return App::getLocale() . '/' . ltrim($path, '/');
}

function locale_url($path = null, $parameters = array(), $secure = null) {
    return url(locale_route($path), $parameters, $secure);
}

function admin_url($path = null, $parameters = array(), $secure = null) {
    return locale_url(Config::get('thor::admin.route_prefix') . '/' . ltrim($path, '/'), $parameters, $secure);
}

/**
 * The currently authenticated user (or null)
 * @return Mjolnic\Thor\User | null
 */
function auth_user(){
    return Auth::user();
}