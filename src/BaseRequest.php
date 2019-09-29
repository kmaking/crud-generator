<?php

namespace KMAKing\CrudGenerator;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Model for the current request.
     * @var
     */
    protected $model;

    protected function setModel($class, $routeName = '')
    {
        if (empty($routeName)) {
            $routeName = strtolower(class_basename($class));
        }

        $model = $this->route($routeName);

        $model = $model ?? $class;

        $this->model = $model;
    }

    /**
     * Check if the user can continue in the request or not.
     * @param $action
     * @return bool
     **/
    protected function can($action)
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        return $user->can($action, $this->model);
    }

    protected function isAuthorized()
    {

        if ($this->isCreate() || $this->isStore()) {
            // Determine if the user is authorized to create an item,
            return true;
            // return $this->can('create');
        }

        if ($this->isEdit() || $this->isUpdate()) {
            // Determine if the user is authorized to update an item,
            return true;
            // return $this->can('update');
        }

        if ($this->isDelete()) {
            // Determine if the user is authorized to delete an item,
            return true;
            // return $this->can('destroy');
        }

        return $this->can('view');
    }

    /**
     * Check the process is create.
     *
     * @return bool
     **/
    protected function isCreate()
    {
        if ($this->is('*/create')) {
            return true;
        }
        return false;
    }

    /**
     * Check the process is store.
     *
     * @return bool
     **/
    protected function isStore()
    {
        if ($this->isMethod('POST')) {
            return true;
        }
        return false;
    }

    /**
     * Check the process is edit.
     *
     * @return bool
     **/
    protected function isEdit()
    {
        if ($this->is('*/edit')) {
            return true;
        }
        return false;
    }

    /**
     * Check the process is update.
     *
     * @return bool
     **/
    protected function isUpdate()
    {
        if ($this->isMethod('PUT') ||
            $this->isMethod('PATCH')
        ) {
            return true;
        }
        return false;
    }

    /**
     * Check the process is verify.
     *
     * @return bool
     **/
    protected function isDelete()
    {
        if ($this->isMethod('DELETE')) {
            return true;
        }
        return false;
    }
}
