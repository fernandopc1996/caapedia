<?php

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;

use App\Helpers\Formatter;

class FormatterTest extends TestCase
{
    public function test_format_small_number(): void
    {
        $this->assertSame('123,00', Formatter::formatNumber(123));
    }

    public function test_format_number_with_suffix_milhao(): void
    {
        $this->assertSame('2 mi', Formatter::formatNumber(2000000));
    }

    public function test_format_negative_number(): void
    {
        $this->assertSame('-150.000,00', Formatter::formatNumber(-150000));
    }
}
