<?php

declare(strict_types=1);

namespace BrDataTools\Support;

class Mask
{
    public static function apply(string $value, string $pattern): string
    {
        $sanitizedValue = Sanitizer::numbers($value);
        $result = '';
        $index = 0;
        $valueLength = strlen($sanitizedValue);

        for ($i = 0, $length = strlen($pattern); $i < $length; $i++) {
            $char = $pattern[$i];

            if ($char === '#') {
                if ($index >= $valueLength) {
                    break;
                }

                $result .= $sanitizedValue[$index];
                $index++;
                continue;
            }

            $result .= $char;
        }

        return $result;
    }
}
