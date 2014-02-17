<?php

namespace Mjolnic\Thor;

use Illuminate\Support\ServiceProvider;

class ThorServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('mjolnic/thor', 'thor');
        
        // Add another directory for extending thor views
        \View::addNamespace('thor', realpath(app_path() . '/views/thor/'));
        
        /*\Event::listen('thor::localeNotFound', function(){
                    dd('Locale not found: '.\Request::segment(1));
        });*/
        
        // To-Do: load language list from database and change the locale config
        
        // Detect locale
        \Mjolnic\Thor\Locale::detect();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}