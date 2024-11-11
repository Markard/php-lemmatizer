<?php

namespace Markard\Dictionary\FindIrregularBaseBehavior;

use Markard\Word;

class IrregularBaseFinder extends AbstractIrregularBaseFinder
{
    /**
     * @inheritdoc
     */
    public function getIrregularBase(Word $word)
    {
        $wordString = $word->asString();
        $exceptions = $this->partOfSpeech->getWordsExceptions();
        if (isset($exceptions[$wordString]) && $exceptions[$wordString] !== $wordString) {
            return $exceptions[$wordString];
        }

        return null;
    }
}
