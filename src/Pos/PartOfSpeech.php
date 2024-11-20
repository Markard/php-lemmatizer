<?php

declare(strict_types=1);

namespace Markard\Pos;

use Markard\BaseFinder\FindRegularBaseBehavior\AbstractRegularBaseFinder;
use Markard\BaseFinder\IrregularBaseFinder;
use Markard\Lemma;
use Markard\Word;

abstract class PartOfSpeech
{
    protected array $data = [];

    protected array $exceptions = [];

    protected IrregularBaseFinder $findIrregularBaseBehavior;

    protected AbstractRegularBaseFinder $findRegularBaseBehavior;

    public function getWordsList(): array
    {
        if (!$this->data) {
            $this->data = $this->loadWordsList();
        }

        return $this->data;
    }

    /**
     * Load words list from configuration file.
     */
    abstract protected function loadWordsList(): array;

    public function getWordsExceptions(): array
    {
        if (!$this->exceptions) {
            $this->exceptions = $this->loadWordsExceptions();
        }

        return $this->exceptions;
    }

    /**
     * Load word exceptions from configuration file.
     */
    abstract protected function loadWordsExceptions(): array;

    public function getIrregularBase(Word $word): ?Lemma
    {
        if ($base = $this->findIrregularBaseBehavior->getIrregularBase($word)) {
            return new Lemma($base, $this->getPartOfSpeechAsString());
        }

        return null;
    }

    abstract public function getPartOfSpeechAsString(): string;

    /**
     * @return Lemma[]
     */
    public function getRegularBases(Word $word): array
    {
        $lemmas = [];
        $bases = $this->findRegularBaseBehavior->getRegularBases($word);
        foreach ($bases as $base) {
            $lemmas[] = new Lemma($base, $this->getPartOfSpeechAsString());
        }

        return $lemmas;
    }
}
