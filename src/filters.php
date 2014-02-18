<?php

Route::filter('admin-auth', function() {
    if (Auth::guest() || (auth_user()->can('access_backend') == false)){
        return Redirect::guest(locale_route('account/login'));
    }
});