<?php

declare(strict_types=1);

namespace Markard;

abstract class Helper
{
    public static function isVowel(string $letter): bool
    {
        return in_array($letter, ['a', 'e', 'i', 'o', 'u']);
    }
}