<?php

namespace app\Model;

Class Logout
{
    private $mIndex;

    public function __construct($mIndex) {
        $this->mIndex = $mIndex;
    }

    public function getMIndex() {

        return $this->mIndex;
    }
}
