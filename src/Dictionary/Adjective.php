<?php

declare(strict_types=1);

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
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
        return require __DIR__ . "/Config/list.adjective.php";
    }

    protected function loadWordsExceptions(): array
    {
        return require __DIR__ . "/Config/exceptions.adjective.php";
    }
}
