<?php 

// The global keyword imports a variable from the global scope into local scope of function

// Example from php.net
function test()
{
    $foo = "local variable";

    echo '$foo in global scope: ' . $GLOBALS["foo"] . "\n";
    echo '$foo in current scope: ' . $foo . "\n";
}

$foo = "Example content"; 
test();

// e.a: 2
$a = 2;

function show(){
    global $a;

    echo $a . PHP_EOL;
}

show();

