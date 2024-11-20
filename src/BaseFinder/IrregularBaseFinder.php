<?php

declare(strict_types=1);

namespace Markard\BaseFinder;

use Markard\Pos\PartOfSpeech;
use Markard\Word;

final class
IrregularBaseFinder
{
    private PartOfSpeech $partOfSpeech;

    public function __construct(PartOfSpeech $partOfSpeech)
    {
        $this->partOfSpeech = $partOfSpeech;
    }

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
