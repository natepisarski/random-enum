<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum\Tests;

use Natepisarski\RandomEnum\RandomEnum;

enum NonBackedEnum
{
    use RandomEnum;
    case FirstCase;
    case SecondCase;
}