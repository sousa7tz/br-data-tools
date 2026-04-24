<?php

declare(strict_types=1);

namespace BrDataTools\Tests;

use BrDataTools\Support\Mask;
use PHPUnit\Framework\TestCase;

class MaskTest extends TestCase
{
    public function testApplyMaskPattern(): void
    {
        self::assertSame(
            '123.456.789-00',
            Mask::apply('12345678900', '###.###.###-##')
        );
    }
}
