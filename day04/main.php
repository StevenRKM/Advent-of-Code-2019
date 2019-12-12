<?php

include("./lib.php");

$min = 264793;
$max = 803935;

print("Part 1: " . countPasswords_part1($min, $max) . "\n");
print("Part 2: " . countPasswords_part2($min, $max) . "\n");