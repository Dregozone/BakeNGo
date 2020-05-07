<?php

    namespace app;

    require_once("Model/Messages.php");
    require_once("View/Messages.php");
    require_once("Controller/Messages.php");

    $model      = new Model\Messages($mIndex);
    $controller = new Controller\Messages($model);
    $view       = new View\Messages($model, $controller);

    $mIndex->findMessage($_SESSION["userName"]);
    $messages = $mIndex->getMessage();

    if ( sizeof($messages) > 0 ) {  // You have messages!
        for ( $num=0, $max=sizeof($messages); $num<$max; $num++ ) {
            echo $view->showMsg($messages[$num]);
        }

    } else {    // No messages currently
        echo 'No messages to display!';
    }

    echo '        
        <p>
            <a href="?p=userdetails" class="bigLink">Back to user details</a>.    
        </p>
    ';
