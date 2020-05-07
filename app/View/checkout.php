<?php

    namespace app\View;

    Class Checkout
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

        public function startBasket() {

            $this->model->getMIndex()->findOrder();
            $nextOrderId = (int)$this->model->getMIndex()->getOrder()[sizeof($this->model->getMIndex()->getOrder())-1]["id"] + 1;

            $this->model->getMIndex()->findUser($_SESSION["userName"]);
            $userId = $this->model->getMIndex()->getUser()[0]["id"];

            $html = '     
                <form action="?p=checkout" method="POST">
                
                    <input type="hidden" name="userIdHidden"      id="userIdHidden"   value="' . $userId . '" />
                    <input type="hidden" name="orderIdHidden"     id="orderIdHidden"  value="' . $nextOrderId . '" />
                    
                    <!-- How many of each product purchased? -->
                    <input type="hidden" name="redVelvetCakeHidden"   id="redVelvetCakeHidden" />
                    <input type="hidden" name="cupcakesHidden"        id="cupcakesHidden" />
                    <input type="hidden" name="sesameBreadHidden"     id="sesameBreadHidden" />
                    
                    <!-- Was discount used on each product? Default to no -->
                    <input type="hidden" name="redVelvetCakeHiddenDiscount"   id="redVelvetCakeHiddenDiscount"    value="0" />
                    <input type="hidden" name="cupcakesHiddenDiscount"        id="cupcakesHiddenDiscount"         value="0" />
                    <input type="hidden" name="sesameBreadHiddenDiscount"     id="sesameBreadHiddenDiscount"      value="0" />
                   
                    <article class="basketItems">                    
                        <table class="basketItemList">
                            <tr>
                                <th class="pad bordered" colspan="2">Item</th>
                                <th class="pad bordered">Price</th>
                                <th class="pad bordered">Qty</th>
                                <th class="pad bordered">Sub-total</th>
                                <th class="pad bordered">Discount Eligible</th>
                            </tr>
            ';

            return $html;
        }

        public function showProductRow($name, $image, $price, $qty, $subTotal, $discountEligible) {

            $html = '
                <tr id="showProduct' . str_replace(" ", "", $name) . '" class="showDiscount">
                    <td class="pad smallImg"> <img src="public/img/' . $image             . '" alt="Image of ' . $name . '" class="smallImg" /> </td>
                    <td class="pad"> ' . $name          . ' </td>
                    <td class="pad"> ' . $price . ' </td>
                    <td class="pad" id="qty' . str_replace(" ", "", $name) . '"> ' . $qty . ' </td>
                    <td class="pad" id="subTotal' . str_replace(" ", "", $name) . '"> ' . $this->model->niceCurrency($subTotal) . ' </td>
                    <td class="pad" id="discount' . str_replace(" ", "", $name) . '"> ' . $discountEligible        . ' </td>
                </tr>
            ';

            return $html;
        }

        public function formOptions($discountAmount) {

            $html = '
                <tr>
                    <th colspan="5" class="right pad">Total exc. VAT</th>
                    <td class="pad"><span id="totalExc"> ' . $this->model->getTotal() . ' </span></td>
                </tr>
                <tr>
                    <th colspan="5" class="right pad">Total inc. VAT</th>
                    <td class="pad"><span id="totalInc"> ' . $this->model->getIncVat() . ' </span></td>
                </tr>

                <tr id="showDiscount" class="showDiscount">
                    <th colspan="5" class="right pad">Discount (' . $discountAmount . '%)</th>
                    <td class="pad"><span id="totalIncPlusDiscount"> ' . $this->model->getDiscountSavings() . ' </span></td>
                </tr>

                <tr>
                    <th colspan="5" class="right pad">To pay</th>
                    <td class="pad allBordered"><span id="totalToPay"> ' . $this->model->getToPay() . ' </span></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button onclick="handleForm();">Confirm</button>
                    </td>
                </tr>
            ';

            return $html;
        }

        public function endBasket() {

            $html = '
                        </table>
                    </article>
                </form>
            ';

            return $html;
        }

        public function success($msg) {

            $html = '
                <aside class="success">
                    ' . $msg . '
                </aside>
            ';

            return $html;
        }

        public function redirect($page) {

            $html = '
                <script>
                    setTimeout(function() {
                        emptyBasket();
                        window.location.href = "' . $page . '";
                    }, 1000);
                </script>
            ';

            return $html;
        }

    }
