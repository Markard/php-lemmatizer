<?php

declare(strict_types=1);

namespace Markard;

class Word
{
    private string $word;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function asString(): string
    {
        return $this->word;
    }

    public function isEndsWithEs(): bool
    {
        $ends = ['ches', 'shes', 'oes', 'ses', 'xes', 'zes'];
        foreach ($ends as $end) {
            if (substr($this->word, 0 - strlen($end)) == $end) {
                return true;
            }
        }

        return false;
    }

    public function isEndsWithVerbVowelYs(): bool
    {
        $ends = ['ays', 'eys', 'iys', 'oys', 'uys'];
        foreach ($ends as $end) {
            if (substr($this->word, 0 - strlen($end)) == $end) {
                return true;
            }
        }

        return false;
    }

    public function isEndsWith(string $end): bool
    {
        return str_ends_with($this->word, $end);
    }

    public function isDoubleConsonant(string $suffix): bool
    {
        $length = strlen($this->word) - strlen($suffix);

        return $length > 2
            && Helper::isVowel($this->word[$length - 3])
            && !Helper::isVowel($this->word[$length - 2])
            && $this->word[$length - 2] === $this->word[$length - 1];
    }
}
