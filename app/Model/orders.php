<?php

namespace app\Model;

Class Orders
{
    private $mIndex;

    public function __construct($mIndex) {
        $this->mIndex = $mIndex;
    }

    public function getMIndex() {

        return $this->mIndex;
    }
}
