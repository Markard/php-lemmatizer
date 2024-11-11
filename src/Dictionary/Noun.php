<?php

declare(strict_types=1);

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\NounRegularBaseFinder;
use Markard\Lemma;

class Noun extends PartOfSpeech
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
        return require __DIR__ . "/Config/list.noun.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/Config/exceptions.noun.php";
    }
}
