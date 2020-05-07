<?php

namespace app\View;

Class Messages
{
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model        = $model;
        $this->controller   = $controller;
    }

    public function showMsg($details) {

        $html = '
            <table class="message">
                <tr>
                    <th class="equalWidth">ID</th>
                    <th class="equalWidth">Message</th>
                    <th class="equalWidth">Date Added</th>
                    <th class="equalWidth">Resolved</th>
                </tr>
                
                <tr>
                    <td>' . $details["id"] . '</td>
                    <td>' . $details["message"] . '</td>
                    <td>' . $details["dateAdded"] . '</td>
                    <td>' . $details["resolved"] . '</td>
                </tr>
            </table>
        ';

        return $html;
    }
}
