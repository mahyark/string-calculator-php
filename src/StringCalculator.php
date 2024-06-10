<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class StringCalculator
{
    private int $calledCount = 0;

    public function GetCalledCount(): int
    {
        return $this->calledCount;
    }

    /**
     * @throws Exception
     */
    public function Add(string $numbers): int
    {
        $sum = 0;
        $this->calledCount++;
        $numbersArray = self::getNumbersArray($numbers);

        if (!self::hasNegativeNumbers($numbersArray)) {
            foreach ($numbersArray as $number) {
                $sum += self::getFormattedNumber($number);
            }
        }

        return $sum;
    }

    private function getNumbersArray($numbers): array
    {
        $delimiterAndNumbers = self::getDelimiterAndNumbers($numbers);
        $delimiter = $delimiterAndNumbers['delimiter'];

        if (self::hasCustomDelimiter($numbers)) {
            $numbers = $delimiterAndNumbers['numbers'];
        }

        return array_map('intval', preg_split($delimiter, $numbers));
    }

    private function getDelimiterAndNumbers(string $numbers): array
    {
        $delimiter = '/[\n,]/';

        if (self::hasCustomDelimiter($numbers)) {
            $customDelimiters = str_replace('//', '', preg_split('/\n/', $numbers)[0]);
            $numbers = str_replace("//$customDelimiters", "", $numbers);
            $customDelimitersArray = self::getCustomDelimitersArray($customDelimiters);
            $delimiter = "/[" . implode("", $customDelimitersArray) . "]/";
        }

        return [
            'delimiter' => $delimiter,
            'numbers' => $numbers
        ];
    }

    private function hasCustomDelimiter($numbers): bool
    {
        $customDelimiter = preg_split('/\n/', $numbers)[0];
        if (str_starts_with($customDelimiter, '//')) {
            return true;
        }

        return false;
    }

    private function getCustomDelimitersArray($customDelimiter): array
    {
        $trimmedString = trim($customDelimiter, '[]');
        return explode('][', $trimmedString);
    }

    /**
     * @throws Exception
     */
    private function hasNegativeNumbers($numbersArray): bool
    {
        $negativeNumbers = array();

        foreach ($numbersArray as $number) {
            if ($number < 0) {
                $negativeNumbers[] = $number;
            }
        }

        if (count($negativeNumbers) > 0) {
            $negativeNumbersOutput = implode(', ', $negativeNumbers);
                throw new Exception("negatives not allowed - \"{$negativeNumbersOutput}\"");
        }

        return false;
    }

    private function getFormattedNumber(int $number): int
    {
        return (int) substr($number, -3);
    }
}