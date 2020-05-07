<?php

    namespace app;

    require_once("Model/Reports.php");
    require_once("View/Reports.php");
    require_once("Controller/Reports.php");

    $model      = new Model\Reports($mIndex);
    $controller = new Controller\Reports($model);
    $view       = new View\Reports($model, $controller);

    if ( sizeof($_POST) == 0 ) { // No search submit, show form
        echo '
            <form action="?p=reports" method="post" autocomplete="off">
                <input type="text" name="startDate" id="startDate" placeholder="Start (Y-m-d H:i:s)" />
                <input type="text" name="endDate"   id="endDate"   placeholder="End   (Y-m-d H:i:s)" />
                
                <input type="submit" value="Search" />
            </form>
        ';
    } else { // User has submit a search range

        $startDate  = $mIndex->cleanse($_POST["startDate"]);
        $endDate    = $mIndex->cleanse($_POST["endDate"]);

        echo '
            <h1 class="header">
                Report - Sales in date range: ' . $startDate . ' - ' . $endDate . '. (<a href="?p=reports">Edit</a>)
            </h1>
        ';

        $mIndex->findOrderDateRange($startDate, $endDate);

        $totalSales = 0;
        $totalDiscounts = 0;

        foreach ( $mIndex->getOrder() as $order ) {

            $totalSales     += $order["IncVat"];
            $totalDiscounts += $order["DiscountAmountTotalIncVat"];

            echo '
                <table class="order">
                    <tr>
                        <th>Order ID            </th>
                        <th>Sale amount (Total) </th>
                        <th>Discount Amount     </th>
                        <th>Contact             </th>
                    </tr>
                    <tr>
                        <td>' . $order["id"]                        . '</td>
                        <td>' . $order["IncVat"]                    . '</td>
                        <td>' . $order["DiscountAmountTotalIncVat"] . '</td>
                        <td>' . $order["Contact"]                   . '</td>
                    </tr>
                </table>
            ';
        }

        echo '
            <table class="summary">
                <tr>
                    <th colspan="2"><h2>Summary</h2></th>   
                </tr>
                <tr>
                    <th class="right">Number of orders:</th>
                    <td>' . sizeof($mIndex->getOrder()) . '</td>
                </tr>
                <tr>
                    <th class="right">Total sales:</th>
                    <td>£' . $totalSales . '</td>
                </tr>
                <tr>
                    <th class="right">Total discounts:</th>
                    <td>£' . $totalDiscounts . '</td>
                </tr>
            </table>
        ';
    }
