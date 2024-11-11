<?php

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\AbstractIrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\AbstractRegularBaseFinder;
use Markard\Lemma;
use Markard\Word;

abstract class PartOfSpeech
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $exceptions;

    /**
     * @var AbstractIrregularBaseFinder
     */
    protected $findIrregularBaseBehavior;

    /**
     * @var AbstractRegularBaseFinder
     */
    protected $findRegularBaseBehavior;

    /**
     * @return array
     */
    public function getWordsList()
    {
        if (!$this->data) {
            $this->data = $this->loadWordsList();
        }

        return $this->data;
    }

    /**
     * Load words list from configuration file.
     *
     * @return array
     */
    abstract protected function loadWordsList();

    /**
     * @return array
     */
    public function getWordsExceptions()
    {
        if (!$this->exceptions) {
            $this->exceptions = $this->loadWordsExceptions();
        }

        return $this->exceptions;
    }

    /**
     * Load word exceptions from configuration file.
     *
     * @return array
     */
    abstract protected function loadWordsExceptions();

    /**
     * @param Word $word
     *
     * @return null|Lemma
     */
    public function getIrregularBase(Word $word)
    {
        if ($base = $this->findIrregularBaseBehavior->getIrregularBase($word)) {
            return new Lemma($base, $this->getPartOfSpeechAsString());
        }

        return null;
    }

    /**
     * @return string
     */
    abstract public function getPartOfSpeechAsString();

    /**
     * @param Word $word
     *
     * @return Lemma[]
     */
    public function getRegularBases(Word $word)
    {
        $lemmas = [];
        $bases = $this->findRegularBaseBehavior->getRegularBases($word);
        foreach ($bases as $base) {
            $lemmas[] = new Lemma($base, $this->getPartOfSpeechAsString());
        }

        return $lemmas;
    }
}
