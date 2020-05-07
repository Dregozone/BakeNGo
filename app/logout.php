<?php

    namespace app;

    require_once("Model/Logout.php");
    require_once("View/Logout.php");
    require_once("Controller/Logout.php");

    $model      = new Model\Logout($mIndex);
    $controller = new Controller\Logout($model);
    $view       = new View\Logout($model, $controller);

    $_SESSION["userName"] = "none";

    echo '
        Logout successful!
        
        <script>
            window.location.href = "?p=store";
        </script>
    ';
