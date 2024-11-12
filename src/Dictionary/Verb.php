<?php

declare(strict_types=1);

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\VerbRegularBaseFinder;
use Markard\Lemma;

final class Verb extends PartOfSpeech
{
    public function __construct()
    {
        $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
        $this->findRegularBaseBehavior = new VerbRegularBaseFinder($this);
    }

    public function getPartOfSpeechAsString(): string
    {
        return Lemma::POS_VERB;
    }

    protected function loadWordsList(): array
    {
        return require __DIR__ . "/Config/list.verb.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/Config/exceptions.verb.php";
    }
}
