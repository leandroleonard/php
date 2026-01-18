<?php

class Solution {
    function findJudge($n, $trust) {
        $score = array_fill(0, $n + 1, 0);   

        foreach($trust as $pair){
            $a = $pair[0];
            $b = $pair[1];

            $score[$a]--;
            $score[$b]++;
        }

        for($i = 1; $i <= $n; $i++)
            if($score[$i] == $n - 1)
                return $i;
        

        return -1;
    }
}