<?php

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('lang', 'Comment');
Route::model('page', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('lang', '[0-9]+');
Route::pattern('page', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => App::getLocale(), 'before' => 'auth'), function()
{
    Route::group(array('prefix' => Config::get('thor::admin.route_prefix'), 'before' => 'auth'), function()
    {
        # Lang Management
        Route::get('langs/{lang}/edit', 'AdminLangsController@getEdit');
        Route::post('langs/{lang}/edit', 'AdminLangsController@postEdit');
        Route::get('langs/{lang}/delete', 'AdminLangsController@getDelete');
        Route::post('langs/{lang}/delete', 'AdminLangsController@postDelete');
        Route::controller('langs', 'AdminLangsController');

        # Page Management
        Route::get('pages/{page}/show', 'AdminPagesController@getShow');
        Route::get('pages/{page}/edit', 'AdminPagesController@getEdit');
        Route::post('pages/{page}/edit', 'AdminPagesController@postEdit');
        Route::get('pages/{page}/delete', 'AdminPagesController@getDelete');
        Route::post('pages/{page}/delete', 'AdminPagesController@postDelete');
        Route::controller('pages', 'AdminPagesController');

        # User Management
        Route::get('users/{user}/show', 'AdminUsersController@getShow');
        Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
        Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
        Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
        Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
        Route::controller('users', 'AdminUsersController');

        # User Role Management
        Route::get('roles/{role}/show', 'AdminRolesController@getShow');
        Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
        Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
        Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
        Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
        Route::controller('roles', 'AdminRolesController');

        # Admin Dashboard
        Route::controller('/', 'AdminDashboardController');

    });
});