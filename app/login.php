<?php

    namespace app;

    require_once("Model/Login.php");
    require_once("View/Login.php");
    require_once("Controller/Login.php");

    $model      = new Model\Login($mIndex);
    $controller = new Controller\Login($model);
    $view       = new View\Login($model, $controller);

    if ( sizeof($_POST) > 0 ) { // User has attempted login, check against db and assign to session if valid, else display error

        $userNameAttempt = $mIndex->cleanse($_POST["userName"]);
        $passwordAttempt = $mIndex->cleanse($_POST["password"]);

        $mIndex->findUser($userNameAttempt);

        if ( sizeof($mIndex->getUser()) > 0 ) { // User name exists
            // Check password
            if ( $passwordAttempt == $mIndex->getUser()[0]["password"] ) {

                $_SESSION["userName"] = ucwords($userNameAttempt);

                echo $view->successfulLogin();
            } else {
                // Login failed, redirect back to form
                echo $view->failedLogin();
            }
        }

        echo $view->failedLogin();

    } else { // Form hasnt been submit, display form
        echo $view->form();
    }
