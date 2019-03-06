<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordEn;

/**
 * comparaisonVideoEn
 *
 * @ORM\Table(name="exercisecomparaison_video_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\comparaisonVideoEnRepository")
 */
class comparaisonVideoEn
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
     * @var wordEn
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="comparaisonsVideoEn")
     */
    private $wordEn;

    /**
     * @var PersistentCollection
     * @ORM\ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\comparaisonVideoFr", mappedBy="comparaisonsVideoEn", cascade={"persist", "remove"})
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
     * @return wordEn
     */
    public function getWordEn()
    {
        return $this->wordEn;
    }

    /**
     * @param wordEn $wordEn
     */
    public function setWordEn($wordEn)
    {
        $this->wordEn = $wordEn;
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
     * Set videoLink.
     *
     * @param string $videoLink
     *
     * @return comparaisonVideoEn
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
     * @return comparaisonVideoEn
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
