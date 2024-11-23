<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum;

use BackedEnum;

/**
 * Allows you to access random cases and values from an Enum.
 */
trait RandomEnum
{
    /**
     * Gets a random Enum case
     * @throws RandomEnumSizeException Thrown when the enum has 0 cases
     * @return mixed
     */
    public static function randomCase(): static
    {
        $allCases = static::cases();

        $caseCount = count($allCases);

        if ($caseCount === 0) {
            $currentEnum = static::class;
            throw new RandomEnumSizeException("Random value could not be produced because $currentEnum had no cases");
        }

        if ($caseCount === 1) {
            return $allCases[0];
        }

        $key = array_rand($allCases);

        return $allCases[$key];
    }

    /**
     * Gets a random Enum value if this enum is backed by primitives.
     * @throws RandomEnumValueException|RandomEnumSizeException Thrown when the enum is not backed.
     * @return int|string
     */
    public static function randomValue(): int|string
    {
        $enumClass = static::class;
        // Check if the calling class is a BackedEnum
        if (!is_subclass_of(static::class, BackedEnum::class)) {
            throw new RandomEnumValueException("$enumClass is not backed by a value");
        }
    
        return static::randomCase()->value;
    }

    /**
     * Produces an array of random cases from the Enum.
     * @param int $count
     * @param bool $allowRepeats
     * @throws RandomEnumSizeException Thrown when the Enum has no cases, or when repeats are forbidden but the count is higher than the number of cases.
     * @return array
     */
    public static function randomCaseArray(int $count, bool $allowRepeats = true): array
    {
        if ($count === 0) {
            return [];
        }

        $currentEnum = static::class;
        $casesArray = static::cases();
        $casesCount = count($casesArray);

        if ($casesCount === 0) {
            throw new  RandomEnumSizeException("$currentEnum had no cases, but random cases were requested");
        }

        if (! $allowRepeats && $casesCount < $count) {
            throw new RandomEnumSizeException("$currentEnum did not have enough cases to not repeat. Needs: $count, Has: $casesCount");
        }

        if (! $allowRepeats) {
            shuffle($casesArray);
            return array_slice($casesArray,0, $count);
        }

        // They are okay with repeats, so we'll just iterate down to the count and pull random cases
        $returned = [];
        for ($x = $count; $x > 0; $x--) {
            $returned[] = static::randomCase();
        }

        return $returned;
    }

    /**
     * Gets a random array of values from the enum
     * @param int $count
     * @param bool $allowRepeats
     * @return array
     * @throws RandomEnumSizeException|RandomEnumValueException Can be thrown if there are no enum cases, or if $count is lower than the number of available cases and repeats are forbidden
     */
    public static function randomValueArray(int $count, bool $allowRepeats = true): array
    {
        $enumClass = static::class;
        if (! is_subclass_of(static::class, BackedEnum::class)) {
            throw new RandomEnumValueException("$enumClass is not backed by values");
        }

        $values = static::randomCaseArray($count, $allowRepeats); // This line might throw if $count/$allowRepeats cause an issue
        return array_map(fn (mixed $value) => $value->value, $values);
    }
}