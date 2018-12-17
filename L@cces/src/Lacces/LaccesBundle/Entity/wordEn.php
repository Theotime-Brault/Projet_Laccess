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
     *
     * @ORM\Column(name="word", type="string", length=255)
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
     * @ORM\ ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\wordFr", mappedBy="wordEns")
     */
    private $wordFrs;


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
}
