<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include("./lib.php");

final class Advent02Test extends TestCase
{
    public function testStringToArray(): void
    {
        $this->assertEquals([1,3,2], stringToIntsArray("1,3,2"));
    }

    public function testOperations(): void
    {
        $memory = stringToIntsArray("1,9,10,3,2,3,11,0,99,30,40,50");
        $programcounter = 0;

        $programcounter = operation($programcounter, $memory);
        $this->assertEquals(4, $programcounter);
        $this->assertEquals(stringToIntsArray("1,9,10,70,2,3,11,0,99,30,40,50"), $memory);

        $programcounter = operation($programcounter, $memory);
        $this->assertEquals(8, $programcounter);
        $this->assertEquals(stringToIntsArray("3500,9,10,70,2,3,11,0,99,30,40,50"), $memory);

        $this->expectException(Halted::class);
        $programcounter = operation($programcounter, $memory);
    }

    public function testRunExamples(): void
    {
        $memory = stringToIntsArray("1,9,10,3,2,3,11,0,99,30,40,50");
        run($memory);
        $this->assertEquals(stringToIntsArray("3500,9,10,70,2,3,11,0,99,30,40,50"), $memory);

        $memory = stringToIntsArray("1,0,0,0,99");
        run($memory);
        $this->assertEquals(stringToIntsArray("2,0,0,0,99"), $memory);

        $memory = stringToIntsArray("2,3,0,3,99");
        run($memory);
        $this->assertEquals(stringToIntsArray("2,3,0,6,99"), $memory);

        $memory = stringToIntsArray("2,4,4,5,99,0");
        run($memory);
        $this->assertEquals(stringToIntsArray("2,4,4,5,99,9801"), $memory);

        $memory = stringToIntsArray("1,1,1,4,99,5,6,0,99");
        run($memory);
        $this->assertEquals(stringToIntsArray("30,1,1,4,2,5,6,0,99"), $memory);
    }

}