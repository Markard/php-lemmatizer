<?php

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\AdjectiveRegularBaseFinder;
use Markard\Lemma;

class Adverb extends PartOfSpeech {
  public function __construct() {
    $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
    $this->findRegularBaseBehavior = new AdjectiveRegularBaseFinder($this);
  }

  /**
   * @inheritdoc
   */
  public function getPartOfSpeechAsString() {
    return Lemma::POS_ADVERB;
  }

  /**
   * @inheritdoc
   */
  protected function loadWordsList() {
    return require __DIR__ . "/Config/list.adverb.php";
  }

  /**
   * @inheritdoc
   */
  protected function loadWordsExceptions() {
    return require __DIR__ . "/Config/exceptions.adverb.php";
  }
}
