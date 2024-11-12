<?php

declare(strict_types=1);

namespace Markard\Dictionary\FindRegularBaseBehavior;

use Markard\Dictionary\PartOfSpeech;
use Markard\Lemma;
use Markard\Word;

abstract class AbstractRegularBaseFinder
{
    protected PartOfSpeech $partOfSpeech;

    public function __construct(PartOfSpeech $partOfSpeech)
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * @return string[]
     */
    abstract public function getRegularBases(Word $word): array;

    /**
     * @return string[]
     */
    protected function getMorphologicalSubstitutionBases(Word $word): array
    {
        $bases = [];
        foreach ($this->getMorphologicalSubstitutions() as list($morpho, $origin)) {
            if ($word->isEndsWith($morpho)) {
                $bases[] = substr($word->asString(), 0, -strlen($morpho)) . $origin;
            }
        }

        return $bases;
    }

    /**
     * @return array of arrays like [morpho, origin]
     */
    abstract protected function getMorphologicalSubstitutions(): array;

    /**
     * @param string[] $bases
     *
     * @return string[]
     */
    protected function filterValidBases(array $bases): array
    {
        $result = [];
        foreach ($bases as $base) {
            if ($this->isValidBase($base)) {
                $result[] = $base;
            }
        }

        return $result;
    }

    protected function isValidBase(string $base): bool
    {
        return strlen($base) > 1 && isset($this->partOfSpeech->getWordsList()[$base]) && $this->partOfSpeech->getWordsList()[$base] === $base;
    }
}
