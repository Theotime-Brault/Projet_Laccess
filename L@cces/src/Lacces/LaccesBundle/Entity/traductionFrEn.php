<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * traductionFrEn
 *
 * @ORM\Table(name="traductionFrEn")
 * @ORM\Entity
 */
class traductionFrEn
{

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   *
   * @ORM\OneToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $word_fr;

  /**
   * wordEn
   *
   * @ORM\OneToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $word_en;


  //************************ GETTERS AND SETTERS *****************************


  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getWordFr()
  {
    return $this->word_fr;
  }

  /**
   * @param mixed $word_fr
   */
  public function setWordFr($word_fr)
  {
    $this->word_fr = $word_fr;
  }

  /**
   * @return mixed
   */
  public function getWordEn()
  {
    return $this->word_en;
  }

  /**
   * @param mixed $word_en
   */
  public function setWordEn($word_en)
  {
    $this->word_en = $word_en;
  }

}