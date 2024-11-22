<?php
declare(strict_types=1);

namespace Natepisarski\RandomEnum\Tests;

use Natepisarski\RandomEnum\RandomEnum;

enum EmptyEnum : string
{
    use RandomEnum;
}