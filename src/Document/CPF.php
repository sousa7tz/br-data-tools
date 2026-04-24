<?php

declare(strict_types=1);

namespace BrDataTools\Document;

use BrDataTools\Exceptions\InvalidDocumentException;
use BrDataTools\Support\Mask;
use BrDataTools\Support\Sanitizer;

class CPF
{
    public static function sanitize(string $cpf): string
    {
        return Sanitizer::numbers($cpf);
    }

    public static function isValid(string $cpf): bool
    {
        $document = self::sanitize($cpf);

        if (strlen($document) !== 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $document)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;

            for ($i = 0; $i < $t; $i++) {
                $sum += (int) $document[$i] * (($t + 1) - $i);
            }

            $digit = ((10 * $sum) % 11) % 10;

            if ((int) $document[$t] !== $digit) {
                return false;
            }
        }

        return true;
    }

    public static function format(string $cpf): string
    {
        $sanitizedCpf = self::sanitize($cpf);

        if (!self::isValid($sanitizedCpf)) {
            throw new InvalidDocumentException('Invalid CPF provided.');
        }

        return Mask::apply($sanitizedCpf, '###.###.###-##');
    }
}
