<?php

include("./lib.php");

function readInput() {
    return file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$input = readInput();



function day01_part1(&$input) {
    $total = 0;
    foreach($input as $value) {
        $total += calculation($value);
    }
    return $total;
}

function day01_part2(&$input) {
    $total = 0;
    foreach($input as $value) {
        $total += calculation_part2($value);
    }
    return $total;
}


print("Part 1: " . day01_part1($input) . "\n");
print("Part 2: " . day01_part2($input) . "\n");


