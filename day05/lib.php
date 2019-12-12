<?php

class Halted extends Exception {};
class ModeDoesNotExist extends Exception {};
class OpcodeDoesNotExist extends Exception {};
class InvalidWriteOperation extends Exception {};

const POSITION_MODE = 0;
const IMMEDIATE_MODE = 1;

const MODES = [
    POSITION_MODE,
    IMMEDIATE_MODE,
];

const ADDIDTION_OP = 1;
const MULTIPLICATION_OP = 2;
const INPUT_OP = 3;
const OUTPUT_OP = 4;
const HALT_OP = 99;

const OPCODES = [
    ADDIDTION_OP,
    MULTIPLICATION_OP,
    INPUT_OP,
    OUTPUT_OP,
    HALT_OP,
];

function stringToIntsArray($str) {
    return array_map("intval", explode(",", $str));
}

function operation($programcounter, &$memory) {

    $instruction = $memory[$programcounter];

    $opcode = getOpcodeFromInstruction($instruction);

    if($opcode == ADDIDTION_OP) {

        $a = readMemory($memory, $programcounter, $instruction, 0);
        $b = readMemory($memory, $programcounter, $instruction, 1);

        $value = $a + $b;

        writeMemory($memory, $programcounter, $instruction, 2, $value);

        return $programcounter + 4;

    } else if($opcode == MULTIPLICATION_OP) {

        $a = readMemory($memory, $programcounter, $instruction, 0);
        $b = readMemory($memory, $programcounter, $instruction, 1);

        $value = $a * $b;

        writeMemory($memory, $programcounter, $instruction, 2, $value);

        return $programcounter + 4;

    } else if($opcode == INPUT_OP) {
        $value = 1; // yes, hardcoded, sue me

        writeMemory($memory, $programcounter, $instruction, 0, $value);

        return $programcounter + 2;

    } else if($opcode == OUTPUT_OP) {

        $value = readMemory($memory, $programcounter, $instruction, 0);

        print("$value\n");

        return $programcounter + 2;

    } else if($opcode == HALT_OP) {
        throw new Halted();
    }
}

function readMemory(&$memory, $position, $instruction, $parameter) {

    $mode = getModeFromInstruction($instruction, $parameter);

    $address = $position + $parameter + 1; // +1 because parameter is 0-based!

    if($mode == IMMEDIATE_MODE) {
        return $memory[$address];

    } else if($mode == POSITION_MODE) {
        return $memory[$memory[$address]];
    }
}

function writeMemory(&$memory, $position, $instruction, $parameter, $value) {

    $mode = getModeFromInstruction($instruction, $parameter);

    $address = $position + $parameter + 1; // +1 because parameter is 0-based!

    if($mode == IMMEDIATE_MODE) {
        throw new InvalidWriteOperation("Memory can not be written to in immediate mode!");

    } else if($mode == POSITION_MODE) {
        return $memory[$memory[$address]] = $value;
    }
}

function getOpcodeFromInstruction($instruction) {
    $opcode = $instruction % 100;

    if(!in_array($opcode, OPCODES)) {
        throw new OpcodeDoesNotExist("Opcode does not exist: found $opcode in $instruction");
    }

    return $opcode;
}

function getModeFromInstruction($instruction, $parameter) {
    $position = $parameter + 2; // 2 from opcode

    $mode = intval($instruction / (10 ** $position)) % 10;

    if(!in_array($mode, MODES)) {
        throw new ModeDoesNotExist("Mode does not exist: found $mode in $instruction");
    }

    return $mode;
}

function run(&$memory) {
    $programcounter = 0;
    try {
        while (True) {
            $programcounter = operation($programcounter, $memory);
        }
    } catch(Halted $e) {
        // succesfully completed the program
        return;
    }
}


