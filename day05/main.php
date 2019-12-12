<?php

include("./lib.php");

function readInput() {
    return file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$input = readInput();


function day05_part1(&$input) {
    $memory = stringToIntsArray($input[0]);

    run($memory);
}


day05_part1($input);



