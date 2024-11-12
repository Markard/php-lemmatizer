<?php

declare(strict_types=1);

namespace Markard\Dictionary\FindIrregularBaseBehavior;

use Markard\Word;

class IrregularBaseFinder extends AbstractIrregularBaseFinder
{
    public function getIrregularBase(Word $word): ?string
    {
        $wordString = $word->asString();
        $exceptions = $this->partOfSpeech->getWordsExceptions();
        if (isset($exceptions[$wordString]) && $exceptions[$wordString] !== $wordString) {
            return $exceptions[$wordString];
        }

        return null;
    }
}
