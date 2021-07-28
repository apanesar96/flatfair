<?php
namespace App\test;


use App\controller\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase {
    /**
     @test
     @dataProvider providerInteger
     */
    public function shouldConvert1To1(string $expected, int $input )
    {
        $fizz = new FizzBuzz();
        $this->assertSame($expected, $fizz->convert($input));
    }

    public function providerInteger(): array
    {
        return [
            ["1", 1],
            ["2", 2],
            ["4", 4]
        ];
    }

    /**
     @test
     @dataProvider providerMultiplesOf3
     */
    public function multipleOf3OnlyShouldReturnFizz(string $expected, int $num)
    {
        $fizz = new FizzBuzz();
        $this->assertEquals($expected, $fizz->convert($num));
    }
    public function providerMultiplesOf3(): array
    {
        return [
            ['Fizz', 9],
            ["Fizz", 6],
            ["Fizz", 9],
            ["Fizz", 12],
        ];
    }
    /**
     @test
     @dataProvider providerMultiplesOf5Only
     */
    public function multiplesOf5OnlyShouldReturnBuzz(string $expected, int $num)
    {
        $fizz = new FizzBuzz();
        $this->assertEquals($expected, $fizz->convert($num));
    }
    public function providerMultiplesOf5Only(): array
    {
        return [
            ["Buzz", 5],
            ["Buzz", 10],
            ["Buzz", 20],
        ];
    }

    /**
     @test
     @dataProvider providerMultiplesOf3and5
     */
    public function MultiplesOf3And5ShouldReturnFizzBuzz(string $expected, int $number)
    {
        $fizz = new FizzBuzz();
        $this->assertEquals($expected, $fizz->convert($number));
    }

    public function providerMultiplesOf3and5(): array
    {
        return [
            ["FizzBuzz", 15],
            ["FizzBuzz", 30],
            ["FizzBuzz", 45],
        ];
    }
}
