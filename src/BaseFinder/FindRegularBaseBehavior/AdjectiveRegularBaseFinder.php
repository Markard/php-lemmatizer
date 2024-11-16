<?php

declare(strict_types=1);

namespace Markard\BaseFinder\FindRegularBaseBehavior;

use Markard\Word;

final class AdjectiveRegularBaseFinder extends AbstractRegularBaseFinder
{
    /**
     * @inheritdoc
     */
    public function getRegularBases(Word $word): array
    {
        $bases = [];
        if ($word->isEndsWith('est') && $word->isDoubleConsonant('est')) {
            $bases[] = substr($word->asString(), 0, -4);
        } elseif ($word->isEndsWith('er') && $word->isDoubleConsonant('er')) {
            $bases[] = substr($word->asString(), 0, -3);
        }
        foreach ($this->getMorphologicalSubstitutions() as list($morpho, $origin)) {
            if ($word->isEndsWith($morpho)) {
                $bases[] = substr($word->asString(), 0, -strlen($morpho)) . $origin;
            }
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
            ['er', ''],
            ['est', ''],
            ['er', 'e'],
            ['est', 'e'],
            ['ier', 'y'],
            ['iest', 'y'],
        ];
    }
}
