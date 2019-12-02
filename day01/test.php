<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include("./lib.php");

final class Advent01Test extends TestCase
{
    public function testCalculation(): void
    {
        $this->assertEquals(2, calculation(12));
        $this->assertEquals(2, calculation(14));
        $this->assertEquals(654, calculation(1969));
        $this->assertEquals(33583, calculation(100756));
    }

    public function testCalculation_part2(): void
    {
        $this->assertEquals(2, calculation_part2(14));
        $this->assertEquals(966, calculation_part2(1969));
        $this->assertEquals(50346, calculation_part2(100756));
    }
}