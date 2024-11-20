<?php

declare(strict_types=1);

namespace Markard\Pos;

use Markard\BaseFinder\FindRegularBaseBehavior\NounRegularBaseFinder;
use Markard\BaseFinder\IrregularBaseFinder;
use Markard\Lemma;

final class Noun extends PartOfSpeech
{
    public function __construct()
    {
        $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
        $this->findRegularBaseBehavior = new NounRegularBaseFinder($this);
    }

    public function getPartOfSpeechAsString(): string
    {
        return Lemma::POS_NOUN;
    }

    protected function loadWordsList(): array
    {
        return require __DIR__ . "/../Dictionary/list.noun.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/../Dictionary/exceptions.noun.php";
    }
}
