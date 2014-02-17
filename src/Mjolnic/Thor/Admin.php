<?php

namespace Mjolnic\Thor;

use Route;

class Admin {

    public static function resource($nameSingular, $namePlural) {
        $rt = 'admin.' . $namePlural;
        $ctrl = '\\Mjolnic\\Thor\\Admin\\' . ucfirst($namePlural) . 'Controller';
        $model = '\\Mjolnic\\Thor\\' . ucfirst($nameSingular);
        
        Route::model($nameSingular, $model);
        Route::pattern($nameSingular, '[0-9]+');

        Route::get($namePlural, array('as' => $rt . '.index', 'uses' => $ctrl . '@index'));
        Route::get($namePlural . '/create', array('as' => $rt . '.create', 'uses' => $ctrl . '@create'));
        Route::post($namePlural, array('as' => $rt . '.store', 'uses' => $ctrl . '@store'));
        Route::get($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.edit', 'uses' => $ctrl . '@edit'));
        Route::get($namePlural . '/{' . $nameSingular . '}/show', array('as' => $rt . '.show', 'uses' => $ctrl . '@show'));
        Route::patch($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.update', 'uses' => $ctrl . '@update'));
        Route::delete($namePlural . '/{' . $nameSingular . '}', array('as' => $rt . '.destroy', 'uses' => $ctrl . '@destroy'));
        Route::controller($namePlural, $ctrl);
    }

    public static function viewName($name) {
        return 'thor::admin.' . $name;
    }

}
