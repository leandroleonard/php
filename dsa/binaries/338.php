<?php

class Solution {

    /**
     * @param integer $n
     * @return integer[]
     */
    function countBits($n) {
        $ans = [];

        for ($i = 0; $i <= $n; $i++){
            $ans[] = substr_count(decbin($i), '1');
        }

        return $ans;
    }
}