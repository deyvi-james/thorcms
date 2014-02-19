<?php

namespace Mjolnic\Thor\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument,
    View;

class Prototype extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates prototype files for a resource: migration, model, controller and views.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        $this->name = thor_ns().':prototype';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        if ($this->option('force') or $this->confirm('Do you wish to create the required classes and views? [yes|no]')) {
            $timestamp = date('Y_m_d_His') . '_';
            $filename_prefix = $this->option('unsafe') ? '' : $timestamp;
            $singular = $this->option('resource');
            $plural = \Illuminate\Support\Str::plural($singular);
            $namespace = $this->option('namespace');
            $vars = compact('singular', 'plural', 'namespace');

            $namespace_path = str_replace('\\', DIRECTORY_SEPARATOR, trim($namespace, '\\'));
            $paths['src'] = app_path() . '/src/' . $namespace_path . '/';
            $paths['views'] = app_path() . '/views/'.thor_ns().'/admin/' . $filename_prefix . $plural . '/';

            $model_name = ucfirst($singular);
            $controller_name = ucfirst($plural) . 'Controller';

            foreach ($paths as $p) {
                if (!is_dir($p)) {
                    mkdir($p, 0775, true);
                }
            }

            $files[$paths['src'] . $filename_prefix . $controller_name] = View::make(thor_ns().'::generators.controller', $vars);
            $files[$paths['src'] . $filename_prefix . $model_name] = View::make(thor_ns().'::generators.model', $vars);
            $files[app_path() . '/database/migrations/' . $timestamp . 'create_' . $plural . '_table'] = View::make(thor_ns().'::generators.migration', $vars);

            $files[$paths['views'] . 'create.blade'] = View::make(thor_ns().'::generators.resource.create', $vars);
            $files[$paths['views'] . 'edit.blade'] = View::make(thor_ns().'::generators.resource.edit', $vars);
            $files[$paths['views'] . 'index.blade'] = View::make(thor_ns().'::generators.resource.index', $vars);
            $files[$paths['views'] . 'show.blade'] = View::make(thor_ns().'::generators.resource.show', $vars);

            foreach ($files as $path => $content) {
                file_put_contents($path . '.php', $content);
            }
            $this->info('Generation succeed. You must call \Mjolnic\Thor\Thor::setAdminResourceRoutes(\'' . $singular .
                    '\',\'' . addslashes($namespace) . '\'); somewhere in your routes.php file');
        } else {
            $this->line('Cancelled');
        }
    }

    /**
     * Get the console cconsoleommand arguments.
     *
     * @return array
     */
    protected function getArguments() {

        return array(
                //array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            array('resource', 'r', InputOption::VALUE_REQUIRED, 'Resource (singular) name.'),
            array('namespace', 'ns', InputOption::VALUE_OPTIONAL, 'Namespace for model and controller classes.', '\\Mjolnic\\Thor\\'),
            array('unsafe', 'u', InputOption::VALUE_NONE, 'Do not prepend timestamp to model, controller nor view files.'),
            array('force', 'f', InputOption::VALUE_NONE, 'Forces the command without confirmation.'),
        );
    }

}
