<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * wordEn
 *
 * @ORM\Table(name="word_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\wordEnRepository")
 */
class wordEn
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
     * @var string
     * @ORM\Column(name="word", type="string", length=255, unique=true)
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(name="videoLink", type="string", length=255)
     */
    private $videoLink;

    /**
     * @var string
     *
     * @ORM\Column(name="contextSentence", type="text")
     */
    private $contextSentence;

    /**
     * @var string
     *
     * @ORM\Column(name="videoLinkSentence", type="string", length=255)
     */
    private $videoLinkSentence;

    /**
     * @var integer
     *
     * @ORM\Column(name="popularity", type="integer")
     */
    private $popularity;

    /**
     * @var PersistentCollection
     * @ORM\ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\wordFr", mappedBy="wordEns")
     */
    private $wordFrs;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmEn", mappedBy="wordEn", cascade={"persist", "remove"})
     */
    private $qcmsEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmVideoEn", mappedBy="wordEn", cascade={"persist", "remove"})
     */
    private $qcmsVideoEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\reformulationEn", mappedBy="wordEn", cascade={"persist", "remove"})
     */
    private $reformulationsEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\significationVideoEn", mappedBy="wordEn", cascade={"persist", "remove"})
     */
    private $significationsVideoEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\comparaisonVideoEn", mappedBy="wordEn", cascade={"persist", "remove"})
     */
    private $comparaisonsVideoEn;

    /**
     * @return PersistentCollection
     */
    public function getComparaisonsVideoEn()
    {
        return $this->comparaisonsVideoEn;
    }

    /**
     * @param PersistentCollection $comparaisonsVideoEn
     */
    public function setComparaisonsVideoEn($comparaisonsVideoEn)
    {
        $this->comparaisonsVideoEn = $comparaisonsVideoEn;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @return PersistentCollection
    */
    public function getWordFrs(){
      return $this->wordFrs;
    }

    /**
     * @param PersistentCollection $wordFrs
     */
    public function setWordFrs(PersistentCollection $wordFrs){
      $this->wordFrs = $wordFrs;
    }

    /**
     * Set word.
     *
     * @param string $word
     *
     * @return wordEn
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word.
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set videoLink.
     *
     * @param string $videoLink
     *
     * @return wordEn
     */
    public function setVideoLink($videoLink)
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    /**
     * Get videoLink.
     *
     * @return string
     */
    public function getVideoLink()
    {
        return $this->videoLink;
    }

    /**
     * Set contextSentence.
     *
     * @param string $contextSentence
     *
     * @return wordEn
     */
    public function setContextSentence($contextSentence)
    {
        $this->contextSentence = $contextSentence;

        return $this;
    }

    /**
     * Get contextSentence.
     *
     * @return string
     */
    public function getContextSentence()
    {
        return $this->contextSentence;
    }

    /**
     * Set popularity.
     *
     * @param integer
     *
     * @return wordFr
     */

    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * Get popularity.
     *
     * @return integer
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @return PersistentCollection
     */
    public function getQcmsEn()
    {
        return $this->qcmsEn;
    }

    /**
     * @param PersistentCollection $qcmsEn
     */
    public function setQcmsEn($qcmsEn)
    {
        $this->qcmsEn = $qcmsEn;
    }

    /**
     * @return PersistentCollection
     */
    public function getQcmsVideoEn()
    {
        return $this->qcmsVideoEn;
    }

    /**
     * @param PersistentCollection $qcmsVideoEn
     */
    public function setQcmsVideoEn($qcmsVideoEn)
    {
        $this->qcmsVideoEn = $qcmsVideoEn;
    }

    /**
     * @return PersistentCollection
     */
    public function getReformulationsEn()
    {
        return $this->reformulationsEn;
    }

    /**
     * @param PersistentCollection $reformulationsEn
     */
    public function setReformulationsEn($reformulationsEn)
    {
        $this->reformulationsEn = $reformulationsEn;
    }

    /**
     * @return PersistentCollection
     */
    public function getSignificationsVideoEn()
    {
        return $this->significationsVideoEn;
    }

    /**
     * @param PersistentCollection $significationsVideoEn
     */
    public function setSignificationsVideoEn($significationsVideoEn)
    {
        $this->significationsVideoEn = $significationsVideoEn;
    }

  /**
   * @return string
   */
  public function getVideoLinkSentence()
  {
    return $this->videoLinkSentence;
  }

  /**
   * @param string $videoLinkSentence
   */
  public function setVideoLinkSentence($videoLinkSentence)
  {
    $this->videoLinkSentence = $videoLinkSentence;
  }
}
