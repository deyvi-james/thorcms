<?php

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('token', '[0-9a-z]+');

// MULTILANGUAGE ROUTES
Route::group(array('prefix' => App::getLocale()), function() {
    /** ------------------------------------------
     *  User account Routes
     *  ------------------------------------------
     */
    Route::group(array('prefix' => 'account'), function() {
        $rt = 'account';
        $ctrl = '\\Mjolnic\\Thor\\AccountController';
        Route::get('/', array('as' => $rt . '.show', 'before' => 'auth', 'uses' => $ctrl . '@show'));
        Route::post('/', array('as' => $rt . '.update', 'before' => 'auth', 'uses' => $ctrl . '@update'));
        Route::get('signup', array('as' => $rt . '.create', 'uses' => $ctrl . '@create'));
        Route::post('signup', array('as' => $rt . '.store', 'uses' => $ctrl . '@store'));
        Route::get('login', array('as' => $rt . '.login', 'uses' => $ctrl . '@login'));
        Route::post('login', array('as' => $rt . '.do_login', 'uses' => $ctrl . '@do_login'));
        Route::get('confirm/{code}', array('as' => $rt . '.confirm', 'uses' => $ctrl . '@confirm'));
        Route::get('forgot', array('as' => $rt . '.forgot', 'uses' => $ctrl . '@forgot_password'));
        Route::post('forgot', array('as' => $rt . '.do_forgot', 'uses' => $ctrl . '@do_forgot_password'));
        Route::get('reset/{token}', array('as' => $rt . '.reset', 'uses' => $ctrl . '@reset_password'));
        Route::post('reset', array('as' => $rt . '.do_reset', 'uses' => $ctrl . '@do_reset_password'));
        Route::get('logout', array('as' => $rt . '.logout', 'uses' => $ctrl . '@logout'));
    });

    /** ------------------------------------------
     *  Admin Routes
     *  ------------------------------------------
     */
    Route::group(array('prefix' => Config::get('thor::admin.route_prefix'), 'before' => 'auth'), function() {

        Mjolnic\Thor\Admin::resource('language', 'languages');

        # Admin Dashboard
        //Route::controller('/', 'AdminDashboardController');
    });
});
