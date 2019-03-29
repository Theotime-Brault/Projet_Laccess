<?php

namespace Lacces\LaccesBundle\Entity\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class FormEditData
{
  /**
   * @Assert\NotBlank
   */
  protected $word;

  /**
   * @Assert\NotBlank
   */
  protected $videoLink;

  /**
   * @Assert\NotBlank
   */
  protected $videoLinkSentence;

  /**
   * @Assert\NotBlank
   */
  protected $contextSentence;

  /**
   * @return mixed
   */
  public function getWord()
  {
    return $this->word;
  }

  /**
   * @param mixed $word
   */
  public function setWord($word)
  {
    $this->word = $word;
  }

  /**
   * @return mixed
   */
  public function getVideoLink()
  {
    return $this->videoLink;
  }

  /**
   * @param mixed $videoLink
   */
  public function setVideoLink($videoLink)
  {
    $this->videoLink = $videoLink;
  }

  /**
   * @return mixed
   */
  public function getContextSentence()
  {
    return $this->contextSentence;
  }

  /**
   * @param mixed $contextSentence
   */
  public function setContextSentence($contextSentence)
  {
    $this->contextSentence = $contextSentence;
  }

  /**
   * @return mixed
   */
  public function getVideoLinkSentence()
  {
    return $this->videoLinkSentence;
  }

  /**
   * @param mixed $videoLinkSentence
   */
  public function setVideoLinkSentence($videoLinkSentence)
  {
    $this->videoLinkSentence = $videoLinkSentence;
  }
}
