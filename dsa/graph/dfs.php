<?php

$graph = [
    'a' => ['b', 'c'],
    'b' => ['d'],
    'c' => ['e'],
    'd' => ['f'],
    'e' => [],
    'f' => []
];

function dfs($gp, string $source){
    
    $stack[] = $source;

    while(count($stack)){
        $current = array_pop($stack);
        echo $current;

        foreach($gp[$current] as $nb)
            array_push($stack, $nb);
        
    }

}

function myFunc(array $graph, string $source): array
{
    $stack   = [$source];
    $visited = [];
    $result  = [];

    while (!empty($stack)) {
        $current = array_pop($stack);

        if (isset($visited[$current])) {
            continue;
        }

        $visited[$current] = true;
        $result[] = $current;

        foreach ($graph[$current] ?? [] as $neighbor) {
            if (!isset($visited[$neighbor])) {
                $stack[] = $neighbor;
            }
        }
    }

    return $result;
}


// dfs($graph, 'a');

function dfs_recursivly($graph, $source){
    echo $source;

    foreach($graph[$source] as $neighbor){
        dfs_recursivly($graph, $neighbor);
    }
}

dfs_recursivly($graph, 'a');