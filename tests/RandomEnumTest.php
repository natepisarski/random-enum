<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum\Tests;

use Natepisarski\RandomEnum\RandomEnumSizeException;
use Natepisarski\RandomEnum\RandomEnumValueException;
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

    public function test_random_case_doesnt_throw_for_unit_enums(): void
    {
        $case = NonBackedEnum::randomCase();
        $this->assertNotNull($case);
    }

    public function test_it_throws_for_empty_enums(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        EmptyEnum::randomCase();
    }

    public function test_we_can_get_random_values_from_enums(): void
    {
        $randomValue = TestingBackedEnum::randomValue();
        $this->assertContains($randomValue, ['first', 'second', 'third']);
    }

    public function test_random_value_throws_for_empty_enums_too(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        EmptyEnum::randomValue();
    }

    public function test_random_value_throws_for_non_backed_enums(): void
    {
        $this->expectException(RandomEnumValueException::class);
        NonBackedEnum::randomValue();
    }

    public function test_get_case_array_throws_for_empty_arrays(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        EmptyEnum::randomCaseArray(1);
    }

    public function test_get_case_array_doesnt_throw_for_non_backed_enums(): void
    {
        $cases = NonBackedEnum::randomCaseArray(2);
        $this->assertNotEmpty($cases);
        $this->assertCount(2, $cases);

        foreach ($cases as $case) {
            $this->assertInstanceOf(NonBackedEnum::class, $case);
        }
    }

    public function test_get_case_array_throws_for_empty_enums(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        EmptyEnum::randomCaseArray(1);
    }

    public function test_get_case_array_doesnt_throw_when_count_is_too_high_but_allow_repeats_is_off(): void
    {
        $value = TestingBackedEnum::randomCaseArray(4);
        $this->assertCount(4, $value);
    }

    public function test_get_case_array_throws_when_allow_repeats_is_off(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        TestingBackedEnum::randomCaseArray(4, false);
    }

    public function test_get_value_array_throws_for_empty_enums(): void
    {
        $this->expectException(RandomEnumSizeException::class);
        EmptyEnum::randomValueArray(1);
    }

    public function test_get_value_array_throws_for_non_backed_enums(): void
    {
        $this->expectException(RandomEnumValueException::class);
        $value = NonBackedEnum::randomValueArray(1);
    }
}