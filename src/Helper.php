<?php

namespace Markard;

abstract class Helper
{
    /**
     * @param string $letter
     *
     * @return bool
     */
    public static function isVowel($letter)
    {
        return in_array($letter, ['a', 'e', 'i', 'o', 'u']);
    }
}