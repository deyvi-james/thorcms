<?php

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('token', '[0-9a-z]+');

// Multilingual routes
Route::group(array('prefix' => App::getLocale()), function() {

    // Account routes
    Mjolnic\Thor\Thor::setAccountRoutes('account');

    // Admin
    Route::group(array('prefix' => Config::get('thor::admin_route_prefix'), 'before' => 'admin-auth'), function() {
        Route::get('/', array('as' => 'admin', 'uses' => function() {
            return View::make(Thor::getViewName('admin_home'));
        }));
    });
    // Resources
    Mjolnic\Thor\Thor::setAdminResourceRoutes('language');
});
