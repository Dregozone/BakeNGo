<?php

    namespace app;

    require_once("Model/Faq.php");
    require_once("View/Faq.php");
    require_once("Controller/Faq.php");

    $model      = new Model\Faq($mIndex);
    $controller = new Controller\Faq($model);
    $view       = new View\Faq($model, $controller);

    echo $view->title("FAQs");

    echo '        
        <dl>
            <dt>How does it work?</dt>
            <dd>
                <ol>
                    <li>Browse catalog and add items to your shopping basket.</li>
                    <li>Apply discount code if you have one and go to checkout.</li>
                    <li>Check order and confirm.</li>
                    <li>Wait for email/phone confirmation that your order is ready for collection.</li>
                    <li>Visit the shop to collect your order, remember your order confirmation number!</li>
                </ol>
            </dd>
            
            <dt>How quickly can my order be ready for collection?</dt>
            <dd>Most deliveries should be available within 48 hours.</dd>
            
            <dt>How do I know when to collect my items?</dt>
            <dd>
                Once your order has been processed and is awaiting collection you will be alerted by email or phone 
                depending on which information was provided on account creation.
            </dd>
            
            <dt>Can I use a discount voucher?</dt>
            <dd>
                Selected discount codes are accepted and can be entered in the shopping cart. 
                Once an item is added to the shopping basket, enter the code at the bottom and it will be applied once 
                you check out to the applicable products in your cart.
            </dd>
            
            <dt>Do you offer delivery?</dt>
            <dd>As a click and collect service, there is no delivery option.</dd>
            
            <dt>Are there multi-purchase offers?</dt>
            <dd>There are currently no offers when purchasing multiple items.</dd>
        </dl>
    ';
