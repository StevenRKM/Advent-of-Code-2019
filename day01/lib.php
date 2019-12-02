<?php

function calculation($mass) {
    return intval(floor($mass / 3) - 2);
}

function calculation_part2($mass) {

    $fuel = calculation($mass);

    if($fuel <= 0)
        return 0;

    return $fuel + calculation_part2($fuel) ;
}
