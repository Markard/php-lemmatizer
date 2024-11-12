<?php

declare(strict_types=1);

namespace Markard;

final class Lemma
{
    const string POS_NOUN = 'noun';
    const string POS_VERB = 'verb';
    const string POS_ADJECTIVE = 'adjective';
    const string POS_ADVERB = 'adverb';

    private string $lemma;

    private ?string $partOfSpeech;

    public function __construct(string $lemma, ?string $partOfSpeech = null)
    {
        $this->lemma = $lemma;
        $this->partOfSpeech = $partOfSpeech;
    }

    public function getLemma(): string
    {
        return $this->lemma;
    }

    public function getPartOfSpeech(): ?string
    {
        return $this->partOfSpeech;
    }
}
