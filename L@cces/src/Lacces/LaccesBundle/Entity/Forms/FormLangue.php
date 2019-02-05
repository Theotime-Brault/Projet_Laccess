<?php

namespace Lacces\LaccesBundle\Entity\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class FormLangue
{
  /**
   * @Assert\NotBlank
   */
  protected $langue;

  /**
   * @return mixed
   */
  public function getLangue()
  {
    return $this->langue;
  }

  /**
   * @param mixed $langue
   */
  public function setLangue($langue)
  {
    $this->langue = $langue;
  }
}
