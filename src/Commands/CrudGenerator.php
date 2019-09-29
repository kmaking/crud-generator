<?php

namespace KMAKing\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use KMAKing\CrudGenerator\Traits\CoreFunctions;

class CrudGenerator extends Command
{
    use CoreFunctions;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud-gen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUDs for Admin Panel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->line('');
        $this->comment('Welcome to KMAKing CrudGenerator');
        $this->comment('Don\'t give any file that are exists in your project, It might be overright your code!');

        $this->guard = $this->choice(
            'Select guard to create CRUDs',
            getGuards()
        );

        // Get Model Name
        $is_new_model = $this->confirm("Do you want to create model?");
        $is_new_migration = $this->confirm("Do you want to create migration for model?");

        $name = $this->ask('Enter your Model Path (eg: User) : ');
        if(is_null($name)) {
            $this->error('Without model name you cannot continue!..');
            exit;
        }

        $this->setModel($name);
        $option = [];
        $option = array_merge($option, ($is_new_model? ['name' => $this->model_path]: []));
        $option = array_merge($option, ($is_new_migration? ['--migration' => true]: []));
        if (count($option)) {
            $this->call('make:model', $option);
        }

        // Get Controller Name
        $controller = null;
        if ($this->confirm(sprintf("Do you want to change controller name? (default: %sController)", $this->model))) {
            $controller = $this->ask('Enter Controller Path (default: UserController) : ');
        }

        // Get View Path Name
        $view_path = null;
        if ($this->confirm(sprintf("Do you want to change view path? (default: %s)", $this->model_lower))) {
            $view_path = $this->ask('Enter View Path : ');
        }

        // Get Breadcrumbs Status
        $breadcrumb = false;
        if ($this->confirm(sprintf("Do you want to add breadcrumbs? (default: yes)"))) {
            $breadcrumb = true;
        }

        // Get Route Prefix
        if ($this->confirm(sprintf("Do you want to change route prefix? (default: %s)", $this->model_lower))) {
            $this->route_prefix = $this->ask('Enter Route Prefix : ');
        }

        $this->controllerAction($controller);
        $this->viewAction($view_path, $breadcrumb);

        $this->controller();
        $this->laratable();
        $this->request();
        $this->views();
        $this->route();
        if($breadcrumb) $this->breadcrumbs();
    }

    /**
     * Checking for controller files.
     *
     * @return void
     */
    public function controller()
    {
        $content = $this->runReplacer('Controller');

        if($this->checkFileExists($this->controller_path)) {
            File::put($this->controller_path, $content);
            $this->info('Controller file Created Successfully at '.$this->controller_path);
        }
    }

    /**
     * Checking for laratable files.
     *
     * @return void
     */
    public function laratable()
    {
        $this->laratableAction();

        $content = $this->runReplacer('Laratables');

        if($this->checkFileExists($this->laratable_path)) {
            File::put($this->laratable_path, $content);
            $this->info('Laratable Created Successfully at '.$this->laratable_path);
        }
    }

    /**
     * Checking for route files.
     *
     * @return void
     */
    public function route()
    {
        $this->routeAction();

        $content = $this->runReplacer('route');

        File::append($this->route_path, $content);
        $this->info('Route added Successfully in '.$this->route_path);
    }

    /**
     * Checking for request files.
     *
     * @return void
     */
    public function request()
    {
        $this->requestAction();

        $content = $this->runReplacer('Request');

        if($this->checkFileExists($this->request_path)) {
            File::put($this->request_path, $content);
            $this->info('Request file Created Successfully at '.$this->request_path);
        }
    }

    /**
     * Checking for view blade files.
     *
     * @return void
     */
    public function views()
    {
        $this->bladeAction();

        foreach ($this->views as $view) {

            $content = $this->runReplacer('user/'.$view);

            $view_path = $this->getBladeFilePath($view);
            if($this->checkFileExists($view_path)) {
                File::put($view_path, $content);
                $this->info('Blade file created successfully at '.$view_path);
            }
        }
    }

    /**
     * Checking for breadcrumb files.
     *
     * @return void
     */
    public function breadcrumbs()
    {
        $this->breadcrumbAction();

        $content = $this->runReplacer('breadcrumbs');

        if($this->checkFileExists($this->breadcrumb_path, true)) {
            File::put($this->breadcrumb_path, '<?php' . PHP_EOL . $content);
        } else {
            File::append($this->breadcrumb_path, $content);
        }
        $this->info('Breadcrumbs added Successfully in ' . $this->breadcrumb_path);
    }
}
