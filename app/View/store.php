<?php

namespace app\View;

    Class Store
    {
        private $model;
        private $controller;

        public function __construct($model, $controller) {
            $this->model        = $model;
            $this->controller   = $controller;
        }

        public function title($title) {

            $html = '
                <h1 class="title">
                    ' . $title . '
                </h1>
            ';

            return $html;
        }

        public function catalogItem($details) {

            $discount = $details["discountEligible"] ? "Item is eligible for discount!" : "Item <b>not</b> eligible for discount.";

            $niceName = str_replace(" ", "_", $details["name"]);

            $html = '
                <article class="item">
                    <article class="itemDetails">
            ';

            $html .= '                
                    <article class="nameHeader"><h2>' . $details["name"] . '</h2></article>
                    <article><img src="public/img/' . $details["name"] . '.jpg" class="catalogImg" alt="Image of ' . $details["name"] . '" /></article>
                    <article>
                        <p>' . $discount . '</p>
                    
                        <button id="add' . $niceName . '" onclick="add(this);">+</button>
                        <button id="rem' . $niceName . '" onclick="rem(this);">-</button>
                    </article>
            ';

            $html .= '
                    </article>
                </article>
            ';

            return $html;
        }

        public function startShoppingBasket() {

            $html = '
                <section class="basket" id="basket">
                    <p class="loggedInAs">
            ';

            if ( $_SESSION["userName"] == "none" ) { // User is not currently logged in
                $html .= 'Please <a href="?p=login" class="bigLink">log in</a> to continue!';
            } else {    // User is logged in, display user name
                $html .= 'Logged in as: ' . $_SESSION["userName"] . '. <a href="?p=userdetails" class="bigLink">View account</a>';
            }

            $html .= '</p>
                    ' . $this->title("My Shopping Basket") . '
                    
                    <article class="basketItems">                    
                        <table class="basketItemList">
                            <tr>
                                <th class="pad bordered">Item</th>
                                <th class="pad bordered">Price</th>
                                <th class="pad bordered">Qty</th>
                                <th class="pad bordered">Sub-total</th>
                            </tr>
            ';

            return $html;
        }

        public function toCheckoutForm() {

            $html = '
                 <form id="toCheckout" action="index.php?p=checkout" method="post">
                    <input type="hidden" name="Red_Velvet_Cake_Hidden" id="Red_Velvet_Cake_Hidden" value="0" />
                    <input type="hidden" name="Sesame_Bread_Hidden"   id="Sesame_Bread_Hidden"   value="0" />
                    <input type="hidden" name="Cupcakes_Hidden"      id="Cupcakes_Hidden"      value="0" />
                    
                    <input type="hidden" name="discountHidden"      id="discountHidden"      value="0" />
                 </form>
            ';

            return $html;
        }

        public function shoppingBasketActions() {

            $disabled = $_SESSION["userName"] == "none" ? " disabled " : "";

            $html = '
                <tr>
                    <td colspan="2">
                        <input type="text" name="discountCode" id="discountCode" placeholder="Discount Code" class="discountCode" aria-label="Discount Code" />
                    </td><td colspan="2">
                        <button id="discount" class="basketButtons discount" onclick="applyDiscount();">Apply</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <button class="basketButtons options" onclick="emptyBasket();">Empty basket</button>
                        <button class="basketButtons options" onclick="toCheckout();" ' . $disabled . '>Checkout</button>
                    </td>
                </tr>
            ';

            return $html;
        }

        public function endShoppingBasket() {

            $html = '
                </section>
                <section class="endFloat"></section>
            ';

            return $html;
        }

        public function basketItem($details) {

            $name  = $details["name"];
            $price = $details["price"];

            $html = '
                <tr id="'       . $name     . '" class="hideItem">
                    <td class="pad">'       . $name     . '</td>
                    <td class="pad">'       . $price    . '</td>
                    <td class="pad"><span id="' . $name       . ' Qty"></span></td>
                    <td class="pad"><span id="' . $name       . ' Sub Total"></span></td>
                </tr>
            ';

            return $html;
        }

        public function showTotals() {

            $html = '
                        <tr>
                            <th colspan="3" class="right pad">Total exc. VAT</th>
                            <td class="pad"><span id="totalExc"> <!-- Sum price exc VAT --> </span></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="right pad">Total inc. VAT</th>
                            <td class="pad"><span id="totalInc"> <!-- Sum price inc VAT --> </span></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4"><span id="discountCell"></span></td>
                        </tr>
                        ' . $this->shoppingBasketActions() . '
                    </table>
                    ' . $this->toCheckoutForm() . '
                </article>
            ';

            return $html;
        }

        public function startItems() {

            $html = '
                <section class="items" id="items">
            ';

            return $html;
        }

        public function endItems() {

            $html = '
                </section>
            ';

            return $html;
        }

    }
