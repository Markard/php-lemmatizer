<?php

declare(strict_types=1);

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
use Markard\Lemma;

class Adverb extends PartOfSpeech
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
        return require __DIR__ . "/Config/list.adverb.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/Config/exceptions.adverb.php";
    }
}
