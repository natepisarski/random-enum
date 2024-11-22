<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RandomEnumTest extends TestCase
{
    #[Test]
    public function it_can_get_a_random_enum_case(): void
    {
        $randomCase = TestingBackedEnum::randomCase();

        $this->assertNotNull($randomCase);
        $this->assertContains($randomCase, TestingBackedEnum::cases());
    }
}