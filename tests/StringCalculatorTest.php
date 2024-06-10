<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use Exception;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }


    /**
     * @test
     */
    public function returnsZeroSumWhenInputEmpty()
    {
        $results = $this->stringCalculator->Add('');
        $this->assertEquals(0, $results);
    }

    /**
     * @test
     */
    public function returnsGivenNumberWhenOneNumberGiven()
    {
        $number = 10;

        $results  = $this->stringCalculator->Add("{$number}");

        $this->assertEquals($number, $results);
    }

    /**
     * @test
     */
    public function returnsSumWhenTwoNumbersGiven()
    {
        $number1 = 5;
        $number2 = 5;

        $results  = $this->stringCalculator->Add("{$number1}, {$number2}");

        $this->assertEquals($number1 + $number2, $results);
    }

    /**
     * @test
     */
    public function returnsSumWhenUnknownAmountOfNumbersGiven()
    {
        $numbers = [5, 10, 15, 20];

        $results  = $this->stringCalculator->Add("{$numbers[0]}, {$numbers[1]}, {$numbers[2]}, {$numbers[3]}");

        $this->assertEquals(array_sum($numbers), $results);
    }

    /**
     * @test
     */
    public function returnsSumWhenNewLineInNumbersGiven()
    {
        $numbers = [5, 10, 15];

        $results  = $this->stringCalculator->Add("{$numbers[0]}\n {$numbers[1]}, {$numbers[2]}");

        $this->assertEquals(array_sum($numbers), $results);
    }

    /**
     * @test
     */
    public function returnsSumOfGivenNumbersWithCustomDelimiter()
    {
        $numbers = [5, 10];
        $customDelimiter = ';';

        $results  = $this->stringCalculator->Add("//{$customDelimiter}\n{$numbers[0]}{$customDelimiter} {$numbers[1]}");

        $this->assertEquals(array_sum($numbers), $results);
    }

    /**
     * @test
     */
    public function returnsExceptionWithNegativeGivenNumber()
    {
        $numbers = [5, -10];

        $this->expectException(Exception::class);

        $this->stringCalculator->Add("{$numbers[0]}, {$numbers[1]}");
    }

    /**
     * @test
     */
    public function returnsExceptionWithAllNegativeGivenNumbers()
    {
        $numbers = [-5, 10, -20];

        $this->expectException(Exception::class);

        $this->stringCalculator->Add("{$numbers[0]}, {$numbers[1]}, {$numbers[2]}");
    }

    /**
     * @test
     */
    public function returnsHowManyTimesAddMethodWasInvoked()
    {
        $results = $this->stringCalculator->GetCalledCount();
        $this->assertEquals(0, $results);
    }

    /**
     * @test
     */
    public function returnsSumWhenAGivenNumberAboveThousand()
    {
        $numbers = [5, 1010, 15];
        $expectedSum = 30;

        $results  = $this->stringCalculator->Add("{$numbers[0]}\n {$numbers[1]}, {$numbers[2]}");

        $this->assertEquals($expectedSum, $results);
    }

    /**
     * @test
     */
    public function returnsSumOfGivenNumbersWithLongCustomDelimiter()
    {
        $numbers = [5, 10];
        $customDelimiter = '***';

        $results  = $this->stringCalculator->Add("//[{$customDelimiter}]\n{$numbers[0]}{$customDelimiter} {$numbers[1]}");

        $this->assertEquals(array_sum($numbers), $results);
    }

    /**
     * @test
     */
    public function returnsSumOfGivenNumbersWithMultipleCustomDelimiter()
    {
        $numbers = [1, 2, 3];
        $customDelimiters = ['***', '%%%'];

        $results  = $this->stringCalculator->Add(
            "//[{$customDelimiters[0]}][{$customDelimiters[1]}]\n{$numbers[0]}{$customDelimiters[0]} {$numbers[1]}{$customDelimiters[1]} {$numbers[2]}"
        );

        $this->assertEquals(array_sum($numbers), $results);
    }
}