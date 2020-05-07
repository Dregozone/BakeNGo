<?php

    namespace app;

    require_once("Model/Orders.php");
    require_once("View/Orders.php");
    require_once("Controller/Orders.php");

    $model      = new Model\Orders($mIndex);
    $controller = new Controller\Orders($model);
    $view       = new View\Orders($model, $controller);


    $mIndex->findOrder("U.name", $_SESSION["userName"]);
    $orders = $mIndex->getOrder();

    $currentOrderNum = "unset";

    if ( sizeof($orders) > 0 ) {  // You have messages!

        for ( $num=0, $max=sizeof($orders); $num<$max; $num++ ) {

            if ( $currentOrderNum == "unset" ) { // First order row
                // Begin first order table
                echo '
                    <table class="order">
                        <tr>
                            <th>Order No.</th>
                            <th>Product ID</th>
                            <th>Qty</th>
                            <th>Order Date</th>
                            <th>Order Complete?</th>
                            <th>Complete Date</th>
                        </tr>
                        <tr>
                            <td>' . $orders[$num]["id"] . '</td>
                            <td>' . $orders[$num]["productId"] . '</td>
                            <td>' . $orders[$num]["productQty"] . '</td>
                            <td>' . $orders[$num]["orderPlacedDate"] . '</td>
                            <td>' . $orders[$num]["orderComplete"] . '</td>
                            <td>' . $orders[$num]["orderCompleteDate"] . '</td>
                        </tr>
                ';

            } else if ( $orders[$num]["id"] == $currentOrderNum ) { // Part of the same order
                // Continue table row
                echo '
                    <tr>
                        <td>' . $orders[$num]["id"] . '</td>
                        <td>' . $orders[$num]["productId"] . '</td>
                        <td>' . $orders[$num]["productQty"] . '</td>
                        <td>' . $orders[$num]["orderPlacedDate"] . '</td>
                        <td>' . $orders[$num]["orderComplete"] . '</td>
                        <td>' . $orders[$num]["orderCompleteDate"] . '</td>
                    </tr>
                ';
            } else { // New order
                // End previous order and start new one
                echo '
                        <tr>
                            <td colspan="6" class="center"><a href="?p=feedback&user=' . $_SESSION["userName"] . '&orderId=' . $orders[$num-1]["id"] . '">Leave feedback on this order</a>.</td>
                        </tr>
                    </table>
                    
                    <table class="order">
                        <tr>
                            <th>Order No.</th>
                            <th>Product ID</th>
                            <th>Qty</th>
                            <th>Order Date</th>
                            <th>Order Complete?</th>
                            <th>Complete Date</th>
                        </tr>
                        <tr>
                            <td>' . $orders[$num]["id"] . '</td>
                            <td>' . $orders[$num]["productId"] . '</td>
                            <td>' . $orders[$num]["productQty"] . '</td>
                            <td>' . $orders[$num]["orderPlacedDate"] . '</td>
                            <td>' . $orders[$num]["orderComplete"] . '</td>
                            <td>' . $orders[$num]["orderCompleteDate"] . '</td>
                        </tr>
                ';
            }

            $currentOrderNum = $orders[$num]["id"];
        }

        // End final order table
        echo '
                <tr>
                    <td colspan="6" class="center"><a href="?p=feedback&user=' . $_SESSION["userName"] . '&orderId=' . (int)$orders[$num-1]["id"] . '">Leave feedback on this order</a>.</td>
                </tr>
            </table>
        ';

    } else {    // No messages currently
        echo 'No orders to display!';
    }

    echo '        
        <p>
            <a href="?p=userdetails" class="bigLink">Back to user details</a>.    
        </p>
    ';
