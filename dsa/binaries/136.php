
<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber($nums) {

        $ans = 0;

        foreach ($nums as $num) {
            $ans ^= $num;
        }

        return $ans;
        
    }
}