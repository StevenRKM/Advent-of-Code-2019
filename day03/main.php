<?php

include("./lib.php");

function readInput() {
    return file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$input = readInput();

function day03_part1(&$input) {
    $line1 = $input[0];
    $line2 = $input[1];

    $coords1 = generateLineCoords(stringToDataArray($line1));
    $coords2 = generateLineCoords(stringToDataArray($line2));

    return getDistanceToClosestCollision($coords1, $coords2);
}


print("Part 1: " . day03_part1($input) . "\n");

