<?php

function countPasswords_part1($min, $max) {

    $total = 0;

    for($i = 1; $i <= 9; $i++) {

        $prefix_i = $i * 10;

        for($j = $i; $j <= 9; $j++) {

            $prefix_j = ($prefix_i + $j) * 10;

            for($k = $j; $k <= 9; $k++) {

                $prefix_k = ($prefix_j + $k) * 10;

                for ($l = $k; $l <= 9; $l++) {

                    $prefix_l = ($prefix_k + $l) * 10;

                    for ($m = $l; $m <= 9; $m++) {

                        $prefix_m = ($prefix_l + $m) * 10;

                        for ($n = $m; $n <= 9; $n++) {
                            $password = $prefix_m + $n;

                            if ($min < $password && $password < $max) {
                                if ($i == $j || $j == $k || $k == $l || $l == $m || $m == $n) {
                                    //print("$password\n");
                                    $total++;
                                }
                            }

                        }

                    }

                }

            }

        }
    }

    return $total;
}

function countPasswords_part2($min, $max) {

    $total = 0;

    for($i = 1; $i <= 9; $i++) {

        $prefix_i = $i * 10;

        for($j = $i; $j <= 9; $j++) {

            $prefix_j = ($prefix_i + $j) * 10;

            for($k = $j; $k <= 9; $k++) {

                $prefix_k = ($prefix_j + $k) * 10;

                for ($l = $k; $l <= 9; $l++) {

                    $prefix_l = ($prefix_k + $l) * 10;

                    for ($m = $l; $m <= 9; $m++) {

                        $prefix_m = ($prefix_l + $m) * 10;

                        for ($n = $m; $n <= 9; $n++) {
                            $password = $prefix_m + $n;

                            if ($min < $password && $password < $max) {

                                $count = array_fill(0, 10, 0);
                                $count[$i]++;
                                $count[$j]++;
                                $count[$k]++;
                                $count[$l]++;
                                $count[$m]++;
                                $count[$n]++;

                                foreach($count as $c) {
                                    if($c == 2) {
                                        //print("$password\n");
                                        $total++;
                                        break;
                                    }
                                }

                            }

                        }

                    }

                }

            }

        }
    }

    return $total;
}