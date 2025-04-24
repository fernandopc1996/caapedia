<?php

namespace App\Helpers;

class Formatter
{
    protected static array $suffixes = [
        3 => 'mil',
        6 => 'mi',
        9 => 'bi',
        12 => 'tri',
    ];

    public static function formatNumber($value, int $decimals = 2, int $maxDigits = 6): string
    {
        $absValue = abs($value);
        $length = strlen((string)intval($absValue));

        foreach (array_reverse(self::$suffixes, true) as $exponent => $suffix) {
            if ($length > $maxDigits && $length > $exponent) {
                $newValue = $value / pow(10, $exponent);
                return number_format($newValue, 0, ',', '.') . ' ' . $suffix;
            }
        }

        return number_format($value, $decimals, ',', '.');
    }
}
