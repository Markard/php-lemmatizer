<?php

declare(strict_types=1);

namespace Markard\BaseFinder\FindRegularBaseBehavior;

use Markard\Word;

final class NounRegularBaseFinder extends AbstractRegularBaseFinder
{
    /**
     * @inheritdoc
     */
    public function getRegularBases(Word $word): array
    {
        $bases = [];
        if ($word->isEndsWithEs()) {
            $bases[] = $nounBase = substr($word->asString(), 0, -2);
            if (!isset($this->partOfSpeech->getWordsList()[$nounBase]) || $this->partOfSpeech->getWordsList()[$nounBase] !== $nounBase) {
                $bases[] = substr($word->asString(), 0, -1);
            }
        } elseif ($word->isEndsWith('s')) {
            $bases[] = substr($word->asString(), 0, -1);
        }

        $bases = array_merge($bases, $this->getMorphologicalSubstitutionBases($word));
        $bases[] = $word->asString();

        return $this->filterValidBases($bases);
    }

    /**
     * @inheritdoc
     */
    protected function getMorphologicalSubstitutions(): array
    {
        return [
            ['ies', 'y'],
            ['ves', 'f'],
            ['men', 'man'],
        ];
    }
}
