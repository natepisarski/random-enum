<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum\Tests;

use Natepisarski\RandomEnum\RandomEnum;

enum TestingBackedEnum: string
{
    use RandomEnum;

    case FirstCase = 'first';
    case SecondCase = 'second';
    case ThirdCase = 'third';
}

