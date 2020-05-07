<?php

    namespace app;

    require_once("Model/Feedback.php");
    require_once("View/Feedback.php");
    require_once("Controller/Feedback.php");

    $model      = new Model\Feedback($mIndex);
    $controller = new Controller\Feedback($model);
    $view       = new View\Feedback($model, $controller);

    echo '
        <h1>
			Feedback
		</h1>
    ';

	var_dump( $_GET );
