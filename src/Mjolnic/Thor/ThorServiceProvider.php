<?php

namespace Mjolnic\Thor;

use Illuminate\Support\ServiceProvider,
    Config;

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

        include __DIR__ . '/../../helpers.php';

        // Add another directory for extending thor views
        \View::addNamespace('thor', realpath(app_path() . '/views/thorcms/'));
        \View::share('admin_window_title', 'ThorCMS' . Thor::VERSION);

        if (\Config::get('thor::i18n_autodetect')) {
            // Detect locale and language
            \Mjolnic\Thor\Language::detect();
        }

        if (\Config::get('thor::load_filters')) {
            include __DIR__ . '/../../filters.php';
        }

        if (\Config::get('thor::load_routes')) {
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
            'Bootstrapper\BootstrapperServiceProvider'
        );
    }

}
