<?php

class Soclution
{
    /**
     * @param int $n
     * @return bool
     */
    function isHappy(int $n): bool{
        $numbers = [];

        while($n != 1){
            if(in_array($n, $numbers)) 
                return false;

            $numbers[] = $n;
            $n = $this->sumNumbers($n);
        }

        return true;
    }
    /**
     * @param int $n
     * @return int
     */
    function sumNumbers(int $n): int{
        $sum = 0;
        while($n > 0){
            $digit = $n % 10;
            $sum += $digit * $digit;
            $n = intval($n /10);
        }

        return $sum;
    }
}


TGLJo273K04CByItRv1jU6svhedHwEbg4DBGTiFE
XfmNPx5vpa3yIZ8KqqqcT4LwfTnXgYIP7wdSVdbs

