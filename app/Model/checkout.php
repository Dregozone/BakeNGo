<?php

    namespace app\Model;

    Class Checkout
    {
        private $mIndex;

        private $discountPotentialExc = 0; // exc VAT, total of discount eligible amounts
        private $nonDiscountPotentialExc = 0; // exc VAT, total of NON-discount eligible amounts

        private $discountPotentialInc = 0; // inc VAT, total of discount eligible amounts
        private $nonDiscountPotentialInc = 0; // inc VAT, total of NON-discount eligible amounts

        private $discountAmount = 0; // Percentage off
        private $discountValue = 0; // Number of pounds off

        private $toPay = 0;

        public function __construct($mIndex) {
            $this->mIndex = $mIndex;
        }

        public function increaseDiscountPotential($by) {
            $this->discountPotentialExc += $by;
        }

        public function increaseNonDiscountPotential($by) {
            $this->nonDiscountPotentialExc += $by;
        }

        public function niceCurrency($from) {

            $parts = explode(".", $from);

            if ( sizeof($parts) == 1 ) {
                $to = $from . '.00';
            } else {

                if ( strlen($parts[1]) == 1 ) {
                    $parts[1] = $parts[1] . '0';
                }

                $to = $parts[0] . '.' . $parts[1];
            }

            return '£' . $to;
        }

        public function getMIndex() {

            return $this->mIndex;
        }
        public function getTotal() {

            return $this->niceCurrency( round( $this->discountPotentialExc + $this->nonDiscountPotentialExc , 2));
        }
        public function getIncVat() {

            $this->discountPotentialInc = $this->discountPotentialExc * 1.2;
            $this->nonDiscountPotentialInc = $this->nonDiscountPotentialExc * 1.2;

            $incVat = $this->discountPotentialInc + $this->nonDiscountPotentialInc;

            return $this->niceCurrency(round($incVat, 2));
        }
        public function getDiscountSavings() {

            $this->discountValue = $this->discountAmount * $this->discountPotentialInc / 100;

            return $this->niceCurrency($this->discountValue);
        }
        public function getToPay() {

            $this->toPay = $this->nonDiscountPotentialInc + ($this->discountPotentialInc - $this->discountValue);

            return $this->niceCurrency(round($this->toPay, 2));
        }

        public function setDiscountAmount($to) {
            $this->discountAmount = $to;
        }

    }
