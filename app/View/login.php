<?php

namespace app\View;

Class Login
{
    private $model;
    private $controller;

    public function __construct($model, $controller) {
        $this->model        = $model;
        $this->controller   = $controller;
    }

    public function form() {

        $html = '
            <form action="?p=login" method="POST" autocomplete="off">
                <fieldset>
                    <article>
                        <label for="username" class="form">Username</label>
                        <input type="text" class="form" name="userName" id="userName" placeholder="Username" />
                    </article>
                    
                    <article>
                        <label for="password" class="form">Password</label>
                        <input type="password" class="form" name="password" id="password" placeholder="Password" />
                    </article>
                    
                    <article>
                        <input type="submit" value="Login" />
                    </article>
                </fieldset>
            </form>
        ';

        return $html;
    }

    public function failedLogin() {

        $html = '
            Login failed!
            
            <script>
                window.location.href = "?p=login";
            </script>
        ';

        return $html;
    }

    public function successfulLogin() {

        $html = '
            Login successful!
            
            <script>
                window.location.href = "?p=store";
            </script>
        ';

        return $html;
    }

}
