<?php

declare(strict_types=1);

namespace Markard\Pos;

use Markard\BaseFinder\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
use Markard\BaseFinder\IrregularBaseFinder;
use Markard\Lemma;

final class Adverb extends PartOfSpeech
{
    public function __construct()
    {
        $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
        $this->findRegularBaseBehavior = new AdjectiveRegularBaseFinder($this);
    }

    public function getPartOfSpeechAsString(): string
    {
        return Lemma::POS_ADVERB;
    }

    protected function loadWordsList(): array
    {
        return require __DIR__ . "/../Dictionary/list.adverb.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/../Dictionary/exceptions.adverb.php";
    }
}
