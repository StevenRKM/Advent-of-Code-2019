<?php

class Halted extends Exception {};

function splitData($data) {
    return [
        substr($data, 0, 1),
        intval(substr($data, 1))
    ];
}

function stringToDataArray($str) {
    return array_map("splitData", explode(",", $str));
}

function generateLineCoords($instructions) {
    $coords = [];

    $currentPoint = [0,0];

    foreach($instructions as $instruction) {

        $direction = $instruction[0];
        $length = $instruction[1];

        $directionHorizontal = 0;
        $directionVertical = 0;

        if($direction == "U") {
            $directionVertical = 1;
        } else if($direction == "D") {
            $directionVertical = -1;
        } else if($direction == "L") {
            $directionHorizontal = -1;
        } else if($direction == "R") {
            $directionHorizontal = 1;
        }

        for($i = 0; $i < $length; $i++) {
            $currentPoint[0] += $directionHorizontal;
            $currentPoint[1] += $directionVertical;

            $coords[] = $currentPoint;
        }

    }

    return $coords;
}

function manhattanDistance($point1, $point2) {
    return intval(abs($point1[0] - $point2[0])) + intval(abs($point1[1] - $point2[1]));
}

function getCollisions(&$line1, &$line2) {
    $collisions = [];

//    foreach($line1 as $coords1) {
    $count = count($line1);
    for($i=0; $i<count($line1); $i++) {
        $coords1 = $line1[$i];
        if(in_array($coords1, $line2)) {
            $collisions[] = $coords1;
        }

        if($i%500 == 0) {
            print(floor(10000 * $i / $count) / 100 . " % \n");
        }
    }

    return $collisions;
}

function getClosestToPoint(&$points, $target) {

    $closestPoint = null;
    $closestDistance = null;

    foreach($points as $point) {
        $distance = manhattanDistance($point, $target);

        if($closestDistance == null || $distance < $closestDistance) {
            $closestPoint = $point;
            $closestDistance = $distance;
        }

    }

    return $closestPoint;
}

function getDistanceToClosestCollision($line1, $line2) {
    $collisions = getCollisions($line1,$line2);

    $closest = getClosestToPoint($collisions, [0,0]);

    $distance = manhattanDistance([0,0], $closest);

    return $distance;
}

