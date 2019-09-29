<?php

if (! function_exists('tag_generator')) {
    /**
     * Generate Tags using Array as Input
     *
     * @param array $data
     * @return string
     */
    function tag_generator(array $data) : string
    {
        $html = '';
        foreach ($data as $name) {
            $html .= '<span class="badge badge-primary" style="margin:2px;">'.str_case($name).'</span>';
        }
        return $html;
    }
}


if (! function_exists('response_data')) {
    /**
     * Generate Response Helper to Set Flash and return to routes
     *
     * @param boolean $status
     * @param string $message
     * @param string $route
     * @return \Illuminate\Http\RedirectResponse
     */
    function response_data(bool $status, string $message = null, string $route = null) : string
    {

        if($status && $message!=null) {
            session()->flash('type', 'success');
            session()->flash('message', $message);
            return $route ?redirect($route): redirect()->back();
        }

        $data = ['type' => 'danger', 'message' => $message ?? "Sommthing went wrong!.."];
        
        if ($route==null) {
            foreach ($data as $key => $value)
                session()->flash($key, $value);
            return redirect()->back();
        } else {
            return redirect($route)->with($data);
        }
    }
}


if (!function_exists('add_active')) {
    /**
     * Add active class to menu
     *
     * @param Array $route
     * @return string
     */
    function add_active(...$route) : string
    {
        if(starts_with(Route::currentRouteName(), $route)) {
            return "active";
        } else {
            return "";
        }
    }
}


if (! function_exists('generate_action_link')) {
    /**
     * Generate Action Link for Action Component
     *
     * @param string $url
     * @param string $title
     * @param Array $attribute
     */
    function generate_action_link(
        string $url, 
        string $title = '<i class="fa fa-check"></i> title', 
        array $attribute = []
    ) : string
    {
        
        $html_attribute = set_attribute($attribute);

        return '<a class="dropdown-item" href="'.$url.'" '.$html_attribute.'>'.$title.'</a>';
    }
}

if (!function_exists("set_option")) {
    /**
     * Set Select Tag Option for Select Form Group Component
     *
     * @param array $options
     * @param array|string $selected
     * @return array
     */
    function set_option(array $options, $selected = "") : array
    {
        // Check for Multiple choice
        if(is_array($selected)) {
            foreach ($selected as $key) { 
                $value = $options[$key];
                $options[$key] = [ 'value' => $value, 'attribute' => 'selected' ]; 
            }
        }

        // Check for Single Choice
        if ($selected!=="") {
            $value = $options[$selected];
            $options[$selected] = [ 'value' => $value, 'attribute' => 'selected' ]; 
        }
        
        return $options;
    }
}

if (!function_exists("set_attribute")) {
    /** 
     * Generate HTML Attribute from Array
     *
     * @param array $attribute
     * @return string
     */
    function set_attribute(array $attribute) : string
    {
        $html = '';
        foreach ($attribute as $key => $value) {
            if(is_string($value))
                $html .= sprintf(" %s=\"%s\"", $key, $value);
            elseif (is_bool($value) && $value)
                $html .= sprintf(" %s", $key);
        }
        return $html;
    }
}

if (!function_exists("script")) {
    /**
     * Generate Script Tag from given path
     *
     * @param string $path
     * @param boolean $is_absolute
     * @param string
     */
    function script(string $path, bool $is_absolute = false) : string
    {
        $url = !$is_absolute? asset($path): $path;
        return '<script type="text/javascript" src="'.$url.'"></script>';
    }
}

if (!function_exists("style")) {
    /**
     * Generate Style Tag from given path
     *
     * @param string $path
     * @param boolean $is_absolute
     * @return string
     */
    function style(string $path, bool $is_absolute = false) : string
    {
        $url = !$is_absolute? asset($path): $path;
        return '<link rel="stylesheet" type="text/css" href="'.$url.'">';
    }
}

if (!function_exists("getGuards")) {
    /**
     * return all guards
     *
     * @param string $type session|token
     * @return array
     */
    function getGuards(string $type = 'session') : array
    {
        return collect(config('auth.guards'))
            ->where('driver', $type)
            ->keys()
            ->all();
    }
}