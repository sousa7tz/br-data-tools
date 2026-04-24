<?php

declare(strict_types=1);

namespace BrDataTools\Tests;

use BrDataTools\Document\CNPJ;
use BrDataTools\Exceptions\InvalidDocumentException;
use PHPUnit\Framework\TestCase;

class CNPJTest extends TestCase
{
    public function testCnpjValidation(): void
    {
        self::assertTrue(CNPJ::isValid('04.252.011/0001-10'));
        self::assertFalse(CNPJ::isValid('11.111.111/1111-11'));
    }

    public function testCnpjFormatting(): void
    {
        self::assertSame('04.252.011/0001-10', CNPJ::format('04252011000110'));
    }

    public function testCnpjFormattingThrowsExceptionForInvalidValue(): void
    {
        $this->expectException(InvalidDocumentException::class);
        CNPJ::format('123');
    }
}
