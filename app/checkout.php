<?php

    namespace app;

    require_once("Model/checkout.php");
    require_once("View/checkout.php");
    require_once("Controller/checkout.php");

    $model      = new Model\Checkout($mIndex);
    $controller = new Controller\Checkout($model);
    $view       = new View\Checkout($model, $controller);

    if ( array_key_exists("discountHidden", $_REQUEST) ) { // User wants to review order

        echo $view->title("Checkout");

        echo $view->startBasket();

            foreach ( $_REQUEST as $name => $item ) {

                if ( $name == "p" ) {
                    // Skip this row
                } else if ( $name == "discountHidden" ) {
                    $discountAmount = $item;
                    $model->setDiscountAmount((int)$discountAmount);
                } else {
                    // Display
                    $name = str_replace("_", " ", str_replace("Hidden", "", $name)); // Make name usable
                    $quantity = $item;

                    // From DB
                    $mIndex->findProduct($name);
                    $productInfo = $mIndex->getProduct()[0];

                    $price = strlen($productInfo["price"]) < 3 ? '£' . $productInfo["price"] . '.00' : '£' . $productInfo["price"] . '0';

                    $subTotal = (float)$productInfo["price"] * $quantity;

                    // Does this product qualify for discount?
                    if ( $productInfo["discountEligible"] ) { // Does qualify
                        $discountEligible = "&#10003;";

                        // How much discount should this product receive
                        $model->increaseDiscountPotential($subTotal);

                    } else { // Does not qualify
                        $discountEligible = "&#10799;";

                        $model->increaseNonDiscountPotential($subTotal);
                    }

                    echo $view->showProductRow($name, $productInfo["image"], $price, $quantity, $subTotal, $discountEligible);

                    $mIndex->resetProducts(); // Clear product info ready for next item
                }
            }

            echo $view->formOptions($discountAmount);
        echo $view->endBasket();

    } else { // User has paid, process this order

        // Add red velvet cakes, if in shopping list
        if ( $_REQUEST["redVelvetCakeHidden"] > 0 ) { // User ordered some of these

            $entry = array();

            $entry["orderId"]               = $_REQUEST["orderIdHidden"];
            $entry["userId"]                = $_REQUEST["userIdHidden"];
            $entry["productId"]             = 1;
            $entry["productQty"]            = $_REQUEST["redVelvetCakeHidden"];
            $entry["discountUsed"]          = $_REQUEST["redVelvetCakeHiddenDiscount"];

            $mIndex->addOrder($entry);

        }


        // Add cupcakes, if in shopping list
        if ( $_REQUEST["cupcakesHidden"] > 0 ) { // User ordered some of these
            $entry = array();

            $entry["orderId"]           = $_REQUEST["orderIdHidden"];
            $entry["userId"]            = $_REQUEST["userIdHidden"];
            $entry["productId"]         = 2;
            $entry["productQty"]        = $_REQUEST["cupcakesHidden"];
            $entry["discountUsed"]      = $_REQUEST["cupcakesHiddenDiscount"];

            $mIndex->addOrder($entry);
        }


        // Add sesame breads, if in shopping list
        if ( $_REQUEST["sesameBreadHidden"] > 0 ) { // User ordered some of these
            $entry = array();

            $entry["orderId"]           = $_REQUEST["orderIdHidden"];
            $entry["userId"]            = $_REQUEST["userIdHidden"];
            $entry["productId"]         = 3;
            $entry["productQty"]        = $_REQUEST["sesameBreadHidden"];
            $entry["discountUsed"]      = $_REQUEST["sesameBreadHiddenDiscount"];

            $mIndex->addOrder($entry);
        }


        //let user know success
        echo $view->success("Order placed successfully!");

        //redirect back to home
        echo $view->redirect("?p=home");
    }
