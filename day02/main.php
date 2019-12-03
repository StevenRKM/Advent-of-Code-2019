<?php

include("./lib.php");

function readInput() {
    return file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$input = readInput();


function day02_part1(&$input) {
    $memory = stringToIntsArray($input[0]);

    $memory[1] = 12;
    $memory[2] = 2;

    run($memory);

    return $memory[0];
}

function day02_part2(&$input) {

    for($noun=0; $noun <= 99; $noun++) {
        for($verb=0; $verb <= 99; $verb++) {
            $memory = stringToIntsArray($input[0]);

            $memory[1] = $noun;
            $memory[2] = $verb;

            run($memory);

            if($memory[0] == 19690720) {
                return (100 * $noun) + $verb;
            }
        }
    }

}

print("Part 1: " . day02_part1($input) . "\n");
print("Part 2: " . day02_part2($input) . "\n");


