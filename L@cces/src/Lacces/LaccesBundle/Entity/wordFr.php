<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Lacces\LaccesBundle\Entity\Exercise\qcmFr;

/**
 * wordFr
 *
 * @ORM\Table(name="word_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\wordFrRepository")
 */
class wordFr
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
     *
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
     * @ORM\ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="wordFrs")
     * @JoinTable(name="traductionFrEn")
     */
    private $wordEns;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmFr", mappedBy="wordFr", cascade={"persist", "remove"})
     */
    private $qcmsFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmVideoFr", mappedBy="wordFr", cascade={"persist", "remove"})
     */
    private $qcmsVideoFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\reformulationFr", mappedBy="wordFr", cascade={"persist", "remove"})
     */
    private $reformulationsFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\significationVideoFr", mappedBy="wordFr", cascade={"persist", "remove"})
     */
    private $significationsVideoFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\comparaisonVideoFr", mappedBy="wordFr", cascade={"persist", "remove"})
     */
    private $comparaisonsVideoFr;

    /**
     * @return PersistentCollection
     */
    public function getComparaisonsVideoFr()
    {
        return $this->comparaisonsVideoFr;
    }

    /**
     * @param PersistentCollection $comparaisonsVideoFr
     */
    public function setComparaisonsVideoFr($comparaisonsVideoFr)
    {
        $this->comparaisonsVideoFr = $comparaisonsVideoFr;
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
    public function getWordEns(){
      return $this->wordEns;
    }

    /**
     * @param PersistentCollection $wordEns
     */
    public function setWordEns(PersistentCollection $wordEns){
      $this->wordEns = $wordEns;
    }

    /**
     * Set word.
     *
     * @param string $word
     * @return wordFr
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
     * @return wordFr
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
     * @return wordFr
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
    public function getQcmsFr()
    {
        return $this->qcmsFr;
    }

    /**
     * @param PersistentCollection $qcmsFr
     */
    public function setQcmsFr($qcmsFr)
    {
        $this->qcmsFr = $qcmsFr;
    }

    /**
     * @return PersistentCollection
     */
    public function getQcmsVideoFr()
    {
        return $this->qcmsVideoFr;
    }

    /**
     * @param PersistentCollection $qcmsVideoFr
     */
    public function setQcmsVideoFr($qcmsVideoFr)
    {
        $this->qcmsVideoFr = $qcmsVideoFr;
    }

    /**
     * @return PersistentCollection
     */
    public function getReformulationsFr()
    {
        return $this->reformulationsFr;
    }

    /**
     * @param PersistentCollection $reformulationsFr
     */
    public function setReformulationsFr($reformulationsFr)
    {
        $this->reformulationsFr = $reformulationsFr;
    }

    /**
     * @return PersistentCollection
     */
    public function getSignificationsVideoFr()
    {
        return $this->significationsVideoFr;
    }

    /**
     * @param PersistentCollection $significationsVideoFr
     */
    public function setSignificationsVideoFr($significationsVideoFr)
    {
        $this->significationsVideoFr = $significationsVideoFr;
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
