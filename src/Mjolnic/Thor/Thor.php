<?php

namespace Mjolnic\Thor;

use Route;

class Thor {
    const VERSION = '1.0.0-dev';
    
    public static function getViewName($name) {
        return \Config::get('thor::views.' . $name);
    }

    public static function setAdminResourceRoutes($nameSingular, $namePlural, $ctrlNs = '\\Mjolnic\\Thor\\Admin\\', $modelNs = '\\Mjolnic\\Thor\\') {
        $rt = \Config::get('thor::admin_route_prefix') . '.' . $namePlural;
        $ctrl = $ctrlNs . ucfirst($namePlural) . 'Controller';
        $model = $modelNs . ucfirst($nameSingular);

        Route::model($nameSingular, $model);
        Route::pattern($nameSingular, '[0-9]+');
        Route::when($nameSingular . '*', function() use ($namePlural) {
            if ((\Entrust::can('access_backend') && \Entrust::can('manage_' . $namePlural)) == false) { // Checks the current user
                return \Redirect::route('admin');
            }
        });

        Route::get($namePlural, array('as' => $rt . '.index', 'uses' => $ctrl . '@index'));
        Route::get($namePlural . '/create', array('as' => $rt . '.create', 'uses' => $ctrl . '@create'));
        Route::post($namePlural, array('as' => $rt . '.store', 'uses' => $ctrl . '@store'));
        Route::get($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.edit', 'uses' => $ctrl . '@edit'));
        Route::get($namePlural . '/{' . $nameSingular . '}/show', array('as' => $rt . '.show', 'uses' => $ctrl . '@show'));
        Route::patch($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.update', 'uses' => $ctrl . '@update'));
        Route::delete($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.destroy', 'uses' => $ctrl . '@destroy'));
        Route::controller($namePlural, $ctrl);
    }

    public static function setDefaultAccountRoutes($rtPrefix = 'account.', $ctrl = '\\Mjolnic\\Thor\\AccountController') {
        Route::get('/', array('as' => $rtPrefix . 'show', 'before' => 'auth', 'uses' => $ctrl . '@show'));
        Route::post('/', array('as' => $rtPrefix . 'update', 'before' => 'auth', 'uses' => $ctrl . '@update'));
        Route::get('signup', array('as' => $rtPrefix . 'create', 'uses' => $ctrl . '@create'));
        Route::post('signup', array('as' => $rtPrefix . 'store', 'uses' => $ctrl . '@store'));
        Route::get('login', array('as' => $rtPrefix . 'login', 'uses' => $ctrl . '@login'));
        Route::post('login', array('as' => $rtPrefix . 'do_login', 'uses' => $ctrl . '@do_login'));
        Route::get('confirm/{code}', array('as' => $rtPrefix . 'confirm', 'uses' => $ctrl . '@confirm'));
        Route::get('forgot_password', array('as' => $rtPrefix . 'forgot_password', 'uses' => $ctrl . '@forgot_password'));
        Route::post('forgot_password', array('as' => $rtPrefix . 'do_forgot_password', 'uses' => $ctrl . '@do_forgot_password'));
        Route::get('reset_password/{token}', array('as' => $rtPrefix . 'reset_password', 'uses' => $ctrl . '@reset_password'));
        Route::post('reset_password', array('as' => $rtPrefix . 'do_reset_password', 'uses' => $ctrl . '@do_reset_password'));
        Route::get('logout', array('as' => $rtPrefix . 'logout', 'uses' => $ctrl . '@logout'));
    }

}
