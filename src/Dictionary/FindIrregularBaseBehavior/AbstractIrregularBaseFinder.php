<?php

declare(strict_types=1);

namespace Markard\Dictionary\FindIrregularBaseBehavior;

use Markard\Dictionary\PartOfSpeech;
use Markard\Word;

abstract class AbstractIrregularBaseFinder
{
    /**
     * @var PartOfSpeech
     */
    protected $partOfSpeech;

    /**
     * @param PartOfSpeech $partOfSpeech
     */
    public function __construct(PartOfSpeech $partOfSpeech)
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * @param Word $word
     *
     * @return null|string
     */
    abstract public function getIrregularBase(Word $word);
}