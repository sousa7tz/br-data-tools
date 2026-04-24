<?php

declare(strict_types=1);

namespace BrDataTools\Tests;

use BrDataTools\Document\CPF;
use BrDataTools\Exceptions\InvalidDocumentException;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    public function testCpfValidation(): void
    {
        self::assertTrue(CPF::isValid('529.982.247-25'));
        self::assertFalse(CPF::isValid('111.111.111-11'));
    }

    public function testCpfFormatting(): void
    {
        self::assertSame('529.982.247-25', CPF::format('52998224725'));
    }

    public function testCpfFormattingThrowsExceptionForInvalidValue(): void
    {
        $this->expectException(InvalidDocumentException::class);
        CPF::format('123');
    }
}
