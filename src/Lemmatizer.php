<?php

declare(strict_types=1);

namespace Markard;

use InvalidArgumentException;
use Markard\Dictionary\Adjective;
use Markard\Dictionary\Adverb;
use Markard\Dictionary\Noun;
use Markard\Dictionary\PartOfSpeech;
use Markard\Dictionary\Verb;

final class Lemmatizer
{
    private static array $partsOfSpeech = [];

    public function __construct()
    {
        if (!self::$partsOfSpeech) {
            self::$partsOfSpeech = [
                Lemma::POS_VERB => new Verb(),
                Lemma::POS_NOUN => new Noun(),
                Lemma::POS_ADJECTIVE => new Adjective(),
                Lemma::POS_ADVERB => new Adverb(),
            ];
        }

        return self::$partsOfSpeech;
    }

    /**
     * @return string[]
     */
    public function getOnlyLemmas(string $word, string $partOfSpeech = null): array
    {
        $result = array_map(function (Lemma $lemma) {
            return $lemma->getLemma();
        }, $this->getLemmas($word, $partOfSpeech));

        return array_unique($result);
    }

    /**
     * Lemmatize a word
     *
     * @return Lemma[]
     */
    public function getLemmas(string $word, string $partOfSpeech = null): array
    {
        $this->validatePartOfSpeech($partOfSpeech);

        $wordEntity = new Word($word);
        if ($partOfSpeech !== null) {
            $lemmas = $this->getBaseFormForPartOfSpeech($wordEntity, $partOfSpeech);
        } else {
            $lemmas = $this->getLemmasForAllPartsOfSpeech($wordEntity);
        }

        return array_unique($lemmas, SORT_REGULAR);
    }

    private function validatePartOfSpeech(?string $partOfSpeech): void
    {
        if ($partOfSpeech !== null && !isset(self::$partsOfSpeech[$partOfSpeech])) {
            $posAsString = implode(' or ', array_keys(self::$partsOfSpeech));
            throw new InvalidArgumentException("partsOfSpeech must be {$posAsString}.");
        }
    }

    /**
     * @return Lemma[]
     */
    public function getBaseFormForPartOfSpeech(Word $wordEntity, string $partOfSpeech): array
    {
        $lemmas = $this->getBaseForm($wordEntity, self::$partsOfSpeech[$partOfSpeech]);

        if (!$lemmas) {
            $lemmas[] = new Lemma($wordEntity->asString(), $partOfSpeech);
        }

        return $lemmas;
    }

    /**
     * @return Lemma[]
     */
    private function getLemmasForAllPartsOfSpeech(Word $word): array
    {
        $lemmas = [];
        foreach (self::$partsOfSpeech as $pos) {
            $lemmas = array_merge($lemmas, $this->getBaseForm($word, $pos));
        }

        if (!$lemmas) {
            foreach (self::$partsOfSpeech as $pos) {
                if (isset($pos->getWordsList()[$word->asString()])) {
                    $lemmas[] = new Lemma($word->asString(), $pos->getPartOfSpeechAsString());
                }
            }
        }

        if (!$lemmas) {
            $lemmas[] = new Lemma($word->asString());
        }

        return $lemmas;
    }

    /**
     * @return Lemma[]
     */
    private function getBaseForm(Word $word, PartOfSpeech $pos): array
    {
        $lemmas = [];
        if ($lemma = $pos->getIrregularBase($word)) {
            $lemmas[] = $lemma;
        }

        return array_merge($lemmas, $pos->getRegularBases($word));
    }
}
