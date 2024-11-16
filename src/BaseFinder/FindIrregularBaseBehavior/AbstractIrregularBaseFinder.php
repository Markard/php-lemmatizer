<?php

declare(strict_types=1);

namespace Markard\BaseFinder\FindIrregularBaseBehavior;

use Markard\Pos\PartOfSpeech;
use Markard\Word;

abstract class AbstractIrregularBaseFinder
{
    protected PartOfSpeech $partOfSpeech;

    public function __construct(PartOfSpeech $partOfSpeech)
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    abstract public function getIrregularBase(Word $word): ?string;
}