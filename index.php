<?php

    session_start();

    require_once("app/Model/index.php");
    require_once("app/View/index.php");
    require_once("app/Controller/index.php");

    $mIndex = new app\Model\Index();
    $cIndex = new app\Controller\Index($mIndex);
    $vIndex = new app\View\Index($mIndex, $cIndex);

    // Take user selected page or go to home by default
    $page = array_key_exists("p", $_GET) &&
            file_exists("app/" . $mIndex->cleanse($_GET["p"]) . ".php")
        ? $mIndex->cleanse($_GET["p"])
        : "home"
    ;

    $cIndex->setPage($page);

    echo $vIndex->startHtml();
        echo $vIndex->header();

        require_once("app/" . $page . ".php");

        echo $vIndex->footer();
    echo $vIndex->endHtml();
