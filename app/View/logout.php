<?php

namespace app\View;

Class Logout
{
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model        = $model;
        $this->controller   = $controller;
    }

}
