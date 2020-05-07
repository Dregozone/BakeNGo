<?php

namespace app\View;

Class Faq
{
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model        = $model;
        $this->controller   = $controller;
    }

    public function title($title) {

        $html = '
                <h1 class="title">
                    ' . $title . '
                </h1>
            ';

        return $html;
    }

}
