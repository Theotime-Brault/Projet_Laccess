<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="contextSentence", type="text")
     */
    private $contextSentence;


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
}
