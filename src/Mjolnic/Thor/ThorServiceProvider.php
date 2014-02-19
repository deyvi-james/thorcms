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
        include __DIR__ . '/../../helpers.php';
        $packageName = thor_package();
        $namespace = thor_ns();
        $this->package($packageName, $namespace);

        // Add another directory for extending thor views
        \Config::addNamespace($namespace, realpath(app_path() . '/config/packages/' . $packageName . '/'));
        \View::addNamespace($namespace, realpath(app_path() . '/views/' . $namespace . '/'));

        \View::share('admin_window_title', \Config::get($namespace . '::brand_name') . ' @Thor-'.Thor::VERSION);

        if (\Config::get($namespace . '::i18n_autodetect') && \Schema::hasTable('languages')) {
            // Detect locale and language
            \Mjolnic\Thor\Language::detect();
        }

        if (\Config::get($namespace . '::load_filters')) {
            include __DIR__ . '/../../filters.php';
        }

        if (\Config::get($namespace . '::load_routes')) {
            include __DIR__ . '/../../routes.php';
        }
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
        return array(
            
        );
    }

}
