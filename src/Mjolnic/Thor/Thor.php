<?php

namespace Mjolnic\Thor;

use Route, Config;

class Thor {

    const VERSION = '1.0.0-dev';

    public static function getViewName($name) {
        return \Config::get('thor::views.' . $name, 'thor::admin.' . str_replace('_', '.', $name));
    }

    public static function setAdminResourceRoutes($singular, $namespace = '\\Mjolnic\\Thor\\') {
        Route::group(array('prefix' => Config::get('thor::admin_route_prefix'), 'before' => 'admin-auth'), function() use($singular, $namespace) {
            $plural = \Str::plural($singular);
            $rt = \Config::get('thor::admin_route_prefix') . '.' . $plural;
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

}
