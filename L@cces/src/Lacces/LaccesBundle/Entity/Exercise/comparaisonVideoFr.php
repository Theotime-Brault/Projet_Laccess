<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordFr;

/**
 * comparaisonVideoFr
 *
 * @ORM\Table(name="exercisecomparaison_video_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\comparaisonVideoFrRepository")
 */
class comparaisonVideoFr
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
     * @var wordFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", inversedBy="comparaisonsVideoFr")
     */
    private $wordFr;

    /**
     * @var PersistentCollection
     * @ORM\ManyToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\comparaisonVideoEn", inversedBy="comparaisonsVideoFr", cascade={"persist", "remove"})
     * @JoinTable(name="comparaisonFrEn")
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
     * @return wordFr
     */
    public function getWordFr()
    {
        return $this->wordFr;
    }

    /**
     * @param wordFr $wordFr
     */
    public function setWordFr($wordFr)
    {
        $this->wordFr = $wordFr;
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
     * @return comparaisonVideoFr
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
     * @return comparaisonVideoFr
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
