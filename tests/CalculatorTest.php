<?php

namespace App\Tests;

use App\Entity\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->calculator = null;
    }

    /**
     * @dataProvider additionDataProvider
     * @param $a
     * @param $b
     * @param $expected
     */
    public function testAddition($a, $b, $expected)
    {
        $calculator = $this->calculator;
        $result = $calculator->add($a,$b);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function additionDataProvider()
    {
        return [
            [5, 3, 8],
            [8, 12, 20],
            [-3, 5, 2],
            [-5, -5, -10],
            [0, 0, 0],
            [1.5, 2.4, 3.9]
        ];
    }

    /**
     * @dataProvider additionalFailDataProvider
     * @param $a
     * @param $b
     */
    public function testAdditionFailsWithObjects($a, $b)
    {
        $calculator = $this->calculator;
        try{
            $calculator->add($a, $b);
            $this->assertTrue(false);
        }
        catch (\UnexpectedValueException $e){
            $this->assertTrue(true);
        }
    }

    /**
     * @return array
     */
    public function additionalFailDataProvider()
    {
        return [
            ['hello', 'world'],
            [new Calculator(), new Calculator()],
            [new Calculator(), 'world']
        ];
    }

    /**
     * @dataProvider subtractionDataProvider
     * @param $a
     * @param $b
     * @param $expected
     */
    public function testSubtract($a, $b, $expected)
    {
        $calculator = $this->calculator;
        $result = $calculator->subtract($a, $b);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function subtractionDataProvider()
    {
        return [
            [3, 2, 1],
            [4, 5, -1],
            [-3, -3, 0],
            [0, -0, 0]
        ];
    }

    /**
     * @dataProvider additionalFailDataProvider
     * @param $a
     * @param $b
     */
    public function testSubtractFailsWithObjects($a, $b)
    {
        $calculator = $this->calculator;
        try{
            $calculator->subtract($a, $b);
            $this->assertTrue(false);
        }
        catch (\UnexpectedValueException $e){
            $this->assertTrue(true);
        }
    }

}
