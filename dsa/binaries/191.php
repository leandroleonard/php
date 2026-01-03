<?php

class Solution {

    /**
     * @param integer $n
     * @return integer
     */
    function hammingWeight($n) {
        $bits = 0;

        while($n > 0){
            if ($n & 1 == 1) $bits += 1;

            $n >>= 1;
        }  

        return $bits;
    }
}