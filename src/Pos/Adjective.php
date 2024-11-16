<?php

declare(strict_types=1);

namespace Markard\Pos;

use Markard\BaseFinder\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\BaseFinder\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
use Markard\Lemma;

final class Adjective extends PartOfSpeech
{
    public function __construct()
    {
        $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
        $this->findRegularBaseBehavior = new AdjectiveRegularBaseFinder($this);
    }

    public function getPartOfSpeechAsString(): string
    {
        return Lemma::POS_ADJECTIVE;
    }

    protected function loadWordsList(): array
    {
        return require __DIR__ . "/../Dictionary/list.adjective.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/../Dictionary/exceptions.adjective.php";
    }
}
