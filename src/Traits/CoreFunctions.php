<?php

namespace KMAKing\CrudGenerator\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait CoreFunctions
{
	/**
     * Guard Name
     *
     * @var $guard
     */
    protected $guard;

    /**
     * Model Name
     *
     * @var $model
     */
    protected $model;

    /**
     * Model Name Lower
     *
     * @var $model_lower
     */
    protected $model_lower;

    /**
     * Layout Name for View
     *
     * @var $layout_name
     */
    protected $layout_name;

    /**
     * Controller Path
     *
     * @var $controller_path
     */
    protected $controller_path;

    /**
     * Controller Namespace
     *
     * @var $controller_namespace
     */
    protected $controller_namespace;

    /**
     * Use statement in controller
     *
     * @var $use_controller
     */
    protected $use_controller;

    /**
     * Laratable file path
     *
     * @var $laratable_path
     */
    protected $laratable_path;

    /**
     * Request file path
     *
     * @var $request_path
     */
    protected $request_path;

    /**
     * View Path Array
     *
     * @var $view_path
     */
    protected $view_path;

    /**
     * Breadcrumb Status
     *
     * @var $is_breadcrumb
     */
    protected $is_breadcrumb;

    /**
     * Breadcrumb Code if $is_breadcrumb true
     *
     * @var $breadcrumbs
     */
    protected $breadcrumbs;

    /**
     * Blade Path
     *
     * @var $blade_path
     */
    protected $blade_path;

    /**
     * Breadcrumbs Path
     *
     * @var $breadcrumb_path
     */
    protected $breadcrumb_path;

    /**
     * Route Prefix
     *
     * @var $route_prefix
     */
    protected $route_prefix = null;

    /**
     * CRUD view file name
     *
     * @var $views
     */
    protected $views = ['create', 'edit', 'form', 'index', 'show'];


	/**
	 * Get Stub based on name
	 *
	 * @param string $type
	 * @return string
	 */
	protected function getStub(string $type) : string
    {
        return file_get_contents(dirname(__DIR__) . '/stub/'.$type.'.stub');
    }

    /**
     * Set Model Property
     *
     * @param string $name
     * @return void
     */
    protected function setModel(string $name) : void
    {
        $name = explode('/', $name);
        $this->model = end($name);
        $name = implode("\\", $name);
        $this->model_path = $name;
        $this->model_lower = strtolower($this->model);
    }

    /**
     * Generate Controller Actions when controller name is available
     * in argument
     *
     * @param string|null $controller
     * @return void
     */
    protected function controllerAction($controller) : void
    {
    	// Check Controller name is null or not
    	if(is_null($controller)) {
    		// Set Controller Path
            $this->controller_path = app_path('Http/Controllers/'.$this->model.'Controller.php');
            $this->controller_name = $this->model.'Controller';

            // Controller namespace and use statement are empty
            $this->controller_namespace = '';
            $this->use_controller = '';
        } else {
        	// Set Controller Path
            $this->controller_path = app_path('Http/Controllers/'.$controller.'.php');
            $this->controller_name = str_replace("/", "\\", $controller);

            // Set Controller namespace
            $this->controller_namespace = explode("/", $controller);
            array_pop($this->controller_namespace);
            $this->controller_namespace = '\\' . implode("\\", $this->controller_namespace);

            // Set Controller use statement
            $this->use_controller = PHP_EOL.'use App\Http\Controllers\Controller;';
        }
    }

    /**
     * Check Laratable Directory exists or not
     * If directory not exists, create by this funtion
     *
     * @return void
     */
    protected function laratableAction() : void
    {
    	// Get Laratables Path
    	$path = app_path('Laratables');

    	// Check Directory is exists or not, If not create it.
        $this->checkAndCreateDirectory($path);

        // Generate Laratable file path
        $this->laratable_path = app_path('Laratables/'.$this->model.'Laratable.php');
    }

    /**
     * Generate View Directory Array from given path
     *
     * @param string|null $view_path
     * @param boolean $is_breadcrumb
     * @return void
     */
    protected function viewAction($view_path, $is_breadcrumb) : void
    {
        // Check View path is null or not
        if(is_null($view_path)) {
            $view_path = strtolower($this->model);
        }

        // Create View directory array
        $this->view_path = explode(".", str_replace("/", ".", $view_path));

        // Is Breadcrumbs
        $this->is_breadcrumb = $is_breadcrumb;
        if($is_breadcrumb)
          $this->breadcrumbs = sprintf("@section('breadcrumbs', Breadcrumbs::render('%s.index'))%s", $this->getRouteName(), PHP_EOL);
        else
          $this->breadcrumbs = '';
    }

    /**
     * Generate Route file patch
     *
     * @return void
     */
    protected function routeAction() : void
    {
        // Create View directory array
        $this->route_path = base_path(sprintf('routes/%s.php', $this->guard));
    }

    /**
     * Get View path from view directory
     *
     * @param string $glue
     * @return string
     */
    protected function getViewPath(string $glue = ".") : string
    {
        return join($glue, $this->view_path);
    }

    /**
     * Get route prefix
     *
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        if (is_null($this->route_prefix)) {
            return str_replace(".", "/", $this->getViewPath());
        }
        return str_replace(".", "/", $this->route_prefix);
    }

    /**
     * Get route name
     *
     * @return string
     */
    protected function getRouteName() : string
    {
        if (is_null($this->route_prefix)) {
            return str_replace("/", ".", $this->getViewPath());
        }
        return str_replace("/", ".", $this->route_prefix);
    }

    /**
     * Check Request Directory exists or not
     * If directory not exists, create by this funtion
     *
     * @return void
     */
    protected function requestAction() : void
    {
        // Get Request Path
        $path = app_path('Http/Requests');

        // Check Directory is exists or not, If not create it.
        $this->checkAndCreateDirectory($path);

        // Generate Laratable file path
        $this->request_path = app_path('Http/Requests/'.$this->model.'Request.php');
    }

    /**
     * Check Blade Directory exists or not
     * If directory not exists, create by this funtion
     *
     * @return void
     */
    protected function bladeAction() : void
    {
        // Get Request Path
        $path = resource_path('views/'.$this->getViewPath('/'));

        // Check Directory is exists or not, If not create it.
        $this->checkAndCreateDirectory($path);

        // Generate Laratable file path
        $this->blade_path = app_path('Http/Request/'.$this->model.'Request.php');
    }

    /**
     * Check Breadcrumb Directory exists or not
     * If directory not exists, create by this funtion
     *
     * @return void
     */
    protected function breadcrumbAction() : void
    {
        // Get Request Path
        $path = base_path('breadcrumbs');

        // Check Directory is exists or not, If not create it.
        $this->checkAndCreateDirectory($path);

        // Generate Laratable file path
        $this->breadcrumb_path = sprintf('%s/%s.php', $path, $this->guard);
    }

    /**
     * Return Blade file path
     *
     * @param string $view
     * @return string
     */
    protected function getBladeFilePath(string $view) : string
    {
        $path = resource_path('views/'.$this->getViewPath('/'));
        return sprintf('%s/%s.blade.php', $path, $view);
    }

    /**
     * Check file is exists in given path
     *
     * @param string $file_path
     * @return boolean
     */
    protected function checkFileExists(string $file_path, bool $is_append = false) : bool
    {
        if ($is_append) {
            $is_new = !File::exists($file_path);
            if ($is_new) {
                $this->info('Breadcrumb file created successfully at '.$file_path);
            }
            return $is_new;
        }

        $is_replace = true;
        if (File::exists($file_path)) {
            $is_replace = $this->confirm('Do you want to replace '.$file_path.' file?');
        }

        if(!$is_replace) {
            $this->error('Cannot create view at '.$file_path);
        }

        return $is_replace;
    }

    /**
     * Get Replace Tags
     *
     * @return array
     */
    protected function getReplaceTags() : array
    {
        return [
            '{{ModelPath}}',
            '{{ModelName}}',
            '{{ModelNamePlural}}',
            '{{ModelNameLowerCase}}',
            '{{ViewPath}}',
            '{{RouteName}}',
            '{{RoutePrefix}}',
            '{{ControllerName}}',
            '{{ControllerNamespace}}',
            '{{UseController}}',
            '{{Layout}}',
            '{{Breadcrumbs}}',
            '{{GuardName}}'
        ];
    }

    /**
     * Get Replace Values
     *
     * @return array
     */
    protected function getReplaceValues() : array
    {
        return [
            $this->model_path,
            $this->model,
            Str::plural($this->model),
            $this->model_lower,
            $this->getViewPath(),
            $this->getRouteName(),
            $this->getRoutePrefix(),
            $this->controller_name,
            $this->controller_namespace,
            $this->use_controller,
            'admin.layout.app',
            $this->breadcrumbs,
            $this->guard=='web'? '': $this->guard.'.'
        ];
    }

    /**
     * Run Replacer
     *
     * @param string $stub
     * @return array
     */
    protected function runReplacer(string $stub) : string
    {
        return str_replace(
            $this->getReplaceTags(),
            $this->getReplaceValues(),
            $this->getStub($stub)
        );
    }



    /**
     * Check Directory exists or not
     * If directory not exists, create by this funtion
     *
     * @param string $path
     * @return void
     */
    protected function checkAndCreateDirectory(string $path) : void
    {
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    }
}
