<?php

namespace app\Model;

Class Contact
{
    private $mIndex;

    public function __construct($mIndex) {
        $this->mIndex = $mIndex;
    }

    public function addMessage($post) {

        $this->mIndex->addMessage(array(
             "name"     => $post["name"]
            ,"email"    => $post["email"]
            ,"message"  => $post["message"]
        ));

        return true;
    }

    public function getMIndex() {

        return $this->mIndex;
    }
}
