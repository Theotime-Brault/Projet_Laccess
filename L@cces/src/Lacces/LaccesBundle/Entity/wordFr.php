<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping\JoinTable;

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
     * @ORM\Column(name="videoDescription", type="text")
     */
    private $videoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="contextSentence", type="text")
     */
    private $contextSentence;

    /**
     * @var integer
     *
     * @ORM\Column(name="popularity", type="integer")
     */
    private $popularity;

    /**
     * @var PersistentCollection
     * @ORM\ ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="wordFrs", cascade={"persist", "remove"})
     * @JoinTable(name="traductionFrEn")
     */
    private $wordEns;

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
     *
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
     * Set videoDescription.
     *
     * @param string $videoDescription
     *
     * @return wordFr
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;

        return $this;
    }

    /**
     * Get videoDescription.
     *
     * @return string
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
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
}
