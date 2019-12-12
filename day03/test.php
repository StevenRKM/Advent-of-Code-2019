<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include("./lib.php");

final class Advent03Test extends TestCase
{
    public function testStringToArray(): void
    {
        $this->assertEquals([["R", 8],["U", 5],["L", 5],["D", 3]], stringToDataArray("R8,U5,L5,D3"));
        $this->assertEquals([["R", 3500],["U", 5],["L", 123],["D", 3]], stringToDataArray("R3500,U5,L123,D3"));
    }

    public function testManhattanDistance(): void
    {
        $this->assertEquals(6, manhattanDistance([0,0], [3,3]));
        $this->assertEquals(2, manhattanDistance([4,2], [3,3]));
        $this->assertEquals(0, manhattanDistance([4,2], [4,2]));
    }

    public function testGenerateLineCoords(): void
    {
        $this->assertEquals([[1, 0]], generateLineCoords([["R", 1]]));
        $this->assertEquals([[1, 0], [2, 0], [3, 0]], generateLineCoords([["R", 3]]));
        $this->assertEquals([[1, 0], [2, 0], [3, 0], [3, -1], [3, -2]], generateLineCoords([["R", 3], ["D", 2]]));
    }

    public function testGetCollisions(): void
    {
        $line1 = [[1, 0]];
        $line2 = [[1, 0], [2, 0], [3, 0]];
        $this->assertEquals([[1, 0]], getCollisions($line1, $line2));

        $line1 = [[3, -1], [22, 0], [3, 0]];
        $line2 = [[1, 0], [2, 0], [3, 0], [3, -1], [3, -2]];
        $this->assertEquals([[3, -1], [3,0]], getCollisions($line1, $line2));
    }

    public function testGetClosestToPoint(): void
    {
        $line = [[6, 3], [1, 1], [1, 0], [5, 5]];
        $this->assertEquals([1, 0], getClosestToPoint($line, [0, 0]));
        $this->assertEquals([6, 3], getClosestToPoint($line, [3, 3]));
    }

    public function testExamples(): void
    {
        $line1 = "R75,D30,R83,U83,L12,D49,R71,U7,L72";
        $line2 = "U62,R66,U55,R34,D71,R55,D58,R83";

        $coords1 = generateLineCoords(stringToDataArray($line1));
        $coords2 = generateLineCoords(stringToDataArray($line2));

        $this->assertEquals(159, getDistanceToClosestCollision($coords1, $coords2));

        $line1 = "R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51";
        $line2 = "U98,R91,D20,R16,D67,R40,U7,R15,U6,R7";

        $coords1 = generateLineCoords(stringToDataArray($line1));
        $coords2 = generateLineCoords(stringToDataArray($line2));

        $this->assertEquals(135, getDistanceToClosestCollision($coords1, $coords2));
    }

}