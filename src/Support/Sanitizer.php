<?php

declare(strict_types=1);

namespace BrDataTools\Support;

class Sanitizer
{
    public static function numbers(string $value): string
    {
        return preg_replace('/\D/', '', $value) ?? '';
    }
}
