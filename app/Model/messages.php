<?php

namespace app\Model;

Class Messages
{
    private $mIndex;

    public function __construct($mIndex) {
        $this->mIndex = $mIndex;
    }

    public function getMIndex() {

        return $this->mIndex;
    }
}
