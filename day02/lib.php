<?php

class Halted extends Exception {};

function stringToIntsArray($str) {
    return array_map("intval", explode(",", $str));
}

function operation($programcounter, &$memory) {

    $opcode = $memory[$programcounter];

    if($opcode == 1) {
        $a = $memory[$memory[$programcounter+1]];
        $b = $memory[$memory[$programcounter+2]];

        $memory[$memory[$programcounter+3]] = $a + $b;

    } else if($opcode == 2) {
        $a = $memory[$memory[$programcounter+1]];
        $b = $memory[$memory[$programcounter+2]];

        $memory[$memory[$programcounter+3]] = $a * $b;

    } else if($opcode == 99) {
        throw new Halted();
    }

    return $programcounter + 4;
}

function run(&$memory) {
    $programcounter = 0;
    try {
        while (True) {
            $programcounter = operation($programcounter, $memory);
        }
    } catch(Halted $e) {
        return;
    }
}
