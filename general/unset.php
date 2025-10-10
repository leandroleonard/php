<?php
/**
 * @author Leandro Ventura
 * Unset
 * unset() is a language construct in PHP, not a regular function.
 * sintax: unset($variable);
 */


$var = "Something";

function destroy_var(){
    global $var;

    // Here, unset will just destroy $var in local scope of function
    unset($var);
}

destroy_var();

echo $var . PHP_EOL;


function destroy(){
    // To destroy $var in all scope, we must use $GLOBALS
    unset($GLOBALS['var']);
}

destroy();

echo $var;