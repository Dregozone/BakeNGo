<?php

    namespace app;

    require_once("Model/store.php");
    require_once("View/store.php");
    require_once("Controller/store.php");

    $model      = new Model\Store($mIndex);
    $controller = new Controller\Store($model);
    $view       = new View\Store($model, $controller);

    $model->findCatalog();

    /*
        if items are eligible for discount AND user has entered the discount code, reduce cost of those items by the determined amount of the "National Voucher Company".
        
        Available voucher codes have an expiry date and if used after this date will NOT WORK.
   
        Requirement: 
        Identify whether a voucher is used
        Identify whether voucher is valid and in date
        Record the date used and either the email or mobile number of the user claiming the voucher 
        This will need to be sent to the voucher company in weekly batches (weekly report of new usage, separate reports page?) - display count of users using codes and the total value of sales using vouchers
        Report should contain above data for the 3rd party but ALSO data for our company: extract relevant sales data to evaluate the success of being in the scheme
    */

    echo $view->startItems();

    echo $view->title("Catalog");

    foreach ( $model->getCatalog() as $row => $details ) {  // For each item in the catalog
        echo $view->catalogItem($details);                  // Display the item
    }

    echo $view->endItems();

    echo $view->startShoppingBasket();

    foreach ( $model->getCatalog() as $row => $details ) {
        echo $view->basketItem($details);
    }

    echo $view->showTotals();

    echo $view->endShoppingBasket();
