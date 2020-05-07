<?php

    namespace app;

    require_once("Model/UserDetails.php");
    require_once("View/UserDetails.php");
    require_once("Controller/UserDetails.php");

    $model      = new Model\UserDetails($mIndex);
    $controller = new Controller\UserDetails($model);
    $view       = new View\UserDetails($model, $controller);

    $mIndex->findUser($_SESSION["userName"]);
    $user = $mIndex->getUser()[0];

    echo '
        <section class="pageContainer">
            <h1>
                User area
            </h1>
            
            <p>
                Logged in as: ' . $_SESSION["userName"] . '. (<a href="?p=logout" class="bigLink">Logout?</a>)
            </p>
            
            <table class="userDetails">
                <tr>
                    <th class="pad">Username:</th>
                    <td class="pad">' . $user["name"] . '</td>
                </tr>
                <tr>
                    <th class="pad">Email:</th>
                    <td class="pad">' . $user["email"] . '</td>
                </tr>
                <tr>
                    <th class="pad">Phone:</th>
                    <td class="pad">' . $user["phone"] . '</td>
                </tr>
                <tr>
                    <th class="pad">Member since:</th>
                    <td class="pad">' . $user["memberSince"] . '</td>
                </tr>
            </table>
            
            <p>
                <a href="?p=orders" class="bigLink">View your orders</a>.
            </p>
            
            <p>
                <a href="?p=messages" class="bigLink">View your messages</a>.
            </p>
        </section>
    ';
