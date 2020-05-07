<?php

namespace app\Model;

    Class Store
    {
        private $mIndex;
        private $catalog = array();

        public function __construct($mIndex) {
            $this->mIndex = $mIndex;
        }

        public function findCatalog() {

            $this->mIndex->findProduct();
            $this->catalog = $this->mIndex->getProduct();
        }

        public function getMIndex() {

            return $this->mIndex;
        }

        public function getCatalog() {

            return $this->catalog;
        }
    }
