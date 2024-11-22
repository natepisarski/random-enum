<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum;

use Exception;

/**
 * Exception that gets thrown when there are not enough enum cases to satisfy the method.
 */
class RandomEnumSizeException extends Exception
{

}