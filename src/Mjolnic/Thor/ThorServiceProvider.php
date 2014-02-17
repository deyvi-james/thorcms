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
        
        // Detect locale and language
        \Mjolnic\Thor\Language::detect();

        include __DIR__.'/../../helpers.php';
        include __DIR__.'/../../filters.php';
        include __DIR__.'/../../routes.php';
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