<?php

    namespace app;

    require_once("Model/contact.php");
    require_once("View/contact.php");
    require_once("Controller/contact.php");

    $model      = new Model\Contact($mIndex);
    $controller = new Controller\Contact($model);
    $view       = new View\Contact($model, $controller);

    echo $view->title("Contact Us");

    if ( sizeof($_POST) > 0 ) { // Form has been submit
        // Process the input
        if ( $model->addMessage($_POST) ) {
            // Message added successfully
            echo $vIndex->success("Message Received!");
        } else {
            // Error adding message
            echo $vIndex->error("Message failed to send, please try again later!");
        }

    } else {                    // No user input yet
        // Display the form
        echo $view->showForm();
    }
