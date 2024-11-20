<?php

declare(strict_types=1);

namespace Markard\Pos;

use Markard\BaseFinder\FindRegularBaseBehavior\VerbRegularBaseFinder;
use Markard\BaseFinder\IrregularBaseFinder;
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
        return require __DIR__ . "/../Dictionary/list.verb.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/../Dictionary/exceptions.verb.php";
    }
}
