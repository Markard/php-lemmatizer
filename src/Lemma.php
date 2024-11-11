<?php

declare(strict_types=1);

namespace Markard;

final class Lemma
{
    const POS_NOUN = 'noun';
    const POS_VERB = 'verb';
    const POS_ADJECTIVE = 'adjective';
    const POS_ADVERB = 'adverb';

    /**
     * @var string
     */
    private $lemma;

    /**
     * @var string|null
     */
    private $partOfSpeech;

    /**
     * @param string $lemma
     * @param string|null $partOfSpeech
     */
    public function __construct(string $lemma, string $partOfSpeech = null)
    {
        $this->lemma = $lemma;
        $this->partOfSpeech = $partOfSpeech;
    }

    public function getLemma(): string
    {
        return $this->lemma;
    }

    /**
     * @return null|string
     */
    public function getPartOfSpeech()
    {
        return $this->partOfSpeech;
    }
}
