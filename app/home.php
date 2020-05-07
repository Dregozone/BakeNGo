<?php

    namespace app;

    require_once("Model/home.php");
    require_once("View/home.php");
    require_once("Controller/home.php");

    $model      = new Model\Home($mIndex);
    $controller = new Controller\Home($model);
    $view       = new View\Home($model, $controller);

    echo '
        <section class="info">
            <article>
                <h2>
                    What do we do?
                </h2>
                
                <p>
                    Bake N Go is a click and collect bakery service, we offer a range of cakes and breads.
                </p>
                
                <p>
                    Simply browse the catalog on the store page and add what you like to the shopping basket. 
                    We will then prepare your baked goods and let you know once available for pick up!
                </p>
                
            </article>
            
            <article>
                <h2>
                    How does it work?
                </h2>
            
                <ol>
                    <li>Browse catalog and add items to your shopping basket.</li>
                    <li>Apply discount code if you have one and go to checkout.</li>
                    <li>Check order and confirm.</li>
                    <li>Wait for email/phone confirmation that your order is ready for collection.</li>
                    <li>Visit the shop to collect your order, remember your order confirmation number!</li>                             
                </ol>
            
            </article>
        </section>
        
        <section class="showcase">
            <h3 class="underline">Products</h3>
            
            <article class="product">
                <img src="public/img/Red Velvet Cake.jpg" class="productImg" alt="" />                        
            </article>
            
            <article class="product">
                <img src="public/img/Cupcakes.jpg" class="productImg" alt="" />                        
            </article>
            
            <article class="product">
                <img src="public/img/Sesame Bread.jpg" class="productImg" alt="" />                        
            </article>
        </section>
    ';
