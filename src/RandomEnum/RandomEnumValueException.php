<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum;

use Exception;

/**
 * Exception that gets thrown when the RandomEnum value functions are called on non-backed Enums
 */
class RandomEnumValueException extends Exception
{
}