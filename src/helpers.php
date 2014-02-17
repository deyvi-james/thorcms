<?php

// Helper functions here

function locale_url($path = null, $parameters = array(), $secure = null) {
    return url(App::getLocale() . '/' . ltrim($path, '/'), $parameters, $secure);
}