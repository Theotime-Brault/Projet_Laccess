<?php

namespace Lacces\LaccesBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class FormData
{
  /**
   * @Assert\NotBlank
   */
  protected $wordFr;

  /**
   * @Assert\NotBlank
   */
  protected $videoLinkFr;

  /**
   * @Assert\NotBlank
   */
  protected $contextSentenceFr;

  /**
   * @Assert\NotBlank
   */
  protected $videoDescriptionFr;

  /**
   * @Assert\NotBlank
   */
  protected $wordEn;

  /**
   * @Assert\NotBlank
   */
  protected $videoLinkEn;

  /**
   * @Assert\NotBlank
   */
  protected $contextSentenceEn;

  /**
   * @Assert\NotBlank
   */
  protected $videoDescriptionEn;


  /**
   * @return mixed
   */
  public function getWordFr()
  {
    return $this->wordFr;
  }

  /**
   * @param mixed $wordFr
   */
  public function setWordFr($wordFr)
  {
    $this->wordFr = $wordFr;
  }

  /**
   * @return mixed
   */
  public function getVideoLinkFr()
  {
    return $this->videoLinkFr;
  }

  /**
   * @param mixed $videoLinkFr
   */
  public function setVideoLinkFr($videoLinkFr)
  {
    $this->videoLinkFr = $videoLinkFr;
  }

  /**
   * @return mixed
   */
  public function getContextSentenceFr()
  {
    return $this->contextSentenceFr;
  }

  /**
   * @param mixed $contextSentenceFr
   */
  public function setContextSentenceFr($contextSentenceFr)
  {
    $this->contextSentenceFr = $contextSentenceFr;
  }

  /**
   * @return mixed
   */
  public function getVideoDescriptionFr()
  {
    return $this->videoDescriptionFr;
  }

  /**
   * @param mixed $videoDescriptionFr
   */
  public function setVideoDescriptionFr($videoDescriptionFr)
  {
    $this->videoDescriptionFr = $videoDescriptionFr;
  }

  /**
   * @return mixed
   */
  public function getWordEn()
  {
    return $this->wordEn;
  }

  /**
   * @param mixed $wordEn
   */
  public function setWordEn($wordEn)
  {
    $this->wordEn = $wordEn;
  }

  /**
   * @return mixed
   */
  public function getVideoLinkEn()
  {
    return $this->videoLinkEn;
  }

  /**
   * @param mixed $videoLinkEn
   */
  public function setVideoLinkEn($videoLinkEn)
  {
    $this->videoLinkEn = $videoLinkEn;
  }

  /**
   * @return mixed
   */
  public function getContextSentenceEn()
  {
    return $this->contextSentenceEn;
  }

  /**
   * @param mixed $contextSentenceEn
   */
  public function setContextSentenceEn($contextSentenceEn)
  {
    $this->contextSentenceEn = $contextSentenceEn;
  }

  /**
   * @return mixed
   */
  public function getVideoDescriptionEn()
  {
    return $this->videoDescriptionEn;
  }

  /**
   * @param mixed $videoDescriptionEn
   */
  public function setVideoDescriptionEn($videoDescriptionEn)
  {
    $this->videoDescriptionEn = $videoDescriptionEn;
  }
}
