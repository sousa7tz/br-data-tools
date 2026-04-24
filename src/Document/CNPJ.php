<?php

declare(strict_types=1);

namespace BrDataTools\Document;

use BrDataTools\Exceptions\InvalidDocumentException;
use BrDataTools\Support\Mask;
use BrDataTools\Support\Sanitizer;

class CNPJ
{
    public static function sanitize(string $cnpj): string
    {
        return Sanitizer::numbers($cnpj);
    }

    public static function isValid(string $cnpj): bool
    {
        $document = self::sanitize($cnpj);

        if (strlen($document) !== 14) {
            return false;
        }

        if (preg_match('/(\d)\1{13}/', $document)) {
            return false;
        }

        $firstDigit = self::calculateDigit(substr($document, 0, 12), 5);
        if ((int) $document[12] !== $firstDigit) {
            return false;
        }

        $secondDigit = self::calculateDigit(substr($document, 0, 13), 6);

        return (int) $document[13] === $secondDigit;
    }

    public static function format(string $cnpj): string
    {
        $sanitizedCnpj = self::sanitize($cnpj);

        if (!self::isValid($sanitizedCnpj)) {
            throw new InvalidDocumentException('Invalid CNPJ provided.');
        }

        return Mask::apply($sanitizedCnpj, '##.###.###/####-##');
    }

    private static function calculateDigit(string $numbers, int $weight): int
    {
        $sum = 0;
        $length = strlen($numbers);

        for ($i = 0; $i < $length; $i++) {
            $sum += (int) $numbers[$i] * $weight;
            $weight--;

            if ($weight < 2) {
                $weight = 9;
            }
        }

        $rest = $sum % 11;

        return $rest < 2 ? 0 : 11 - $rest;
    }
}
