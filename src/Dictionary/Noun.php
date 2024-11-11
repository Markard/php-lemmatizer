<?php

namespace Markard\Dictionary;

use Markard\Dictionary\FindIrregularBaseBehavior\IrregularBaseFinder;
use Markard\Dictionary\FindRegularBaseBehavior\NounRegularBaseFinder;
use Markard\Lemma;

class Noun extends PartOfSpeech {
  public function __construct() {
    $this->findIrregularBaseBehavior = new IrregularBaseFinder($this);
    $this->findRegularBaseBehavior = new NounRegularBaseFinder($this);
  }

  /**
   * @inheritdoc
   */
  public function getPartOfSpeechAsString() {
    return Lemma::POS_NOUN;
  }

  /**
   * @inheritdoc
   */
  protected function loadWordsList() {
    return require __DIR__ . "/Config/list.noun.php";
  }

  /**
   * @inheritdoc
   */
  protected function loadWordsExceptions() {
    return require __DIR__ . "/Config/exceptions.noun.php";
  }
}
