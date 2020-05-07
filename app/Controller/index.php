<?php

    namespace app\Controller;

    Class Index
    {
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function setPage($to) {
            $this->model->setPage($to);
        }
    }
