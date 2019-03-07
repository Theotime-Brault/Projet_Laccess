<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordFr;

/**
 * qcmVideoFr
 *
 * @ORM\Table(name="exerciseqcm_video_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmVideoFrRepository")
 */
class qcmVideoFr
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
     * @var int
     *
     * @ORM\Column(name="solution", type="integer", length=255, nullable=true)
     */
    private $solution;

    /**
     * @var string
     *
     * @ORM\Column(name="videoLink", type="string", length=255)
     */
    private $videoLink;

    /**
     * @var wordFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", inversedBy="qcmsVideoFr")
     */
    private $wordFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmEnonceVideoFr", mappedBy="qcmVideoFr", cascade={"persist", "remove"})
     */
    private $qcmVideoEnoncesFr;

    /**
     * qcmVideoFr constructor.
     * @param string $videoLink
     * @param wordFr $wordFr
     */
    public function __construct($videoLink, wordFr $wordFr)
    {
        $this->videoLink = $videoLink;
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
     * Set solution.
     *
     * @param string $solution
     *
     * @return qcmVideoFr
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * Get solution.
     *
     * @return int
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Set videoLink.
     *
     * @param integer $videoLink
     *
     * @return qcmVideoFr
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
     * @return PersistentCollection
     */
    public function getQcmVideoEnoncesFr()
    {
        return $this->qcmVideoEnoncesFr;
    }

    /**
     * @param PersistentCollection $qcmVideoEnoncesFr
     */
    public function setQcmVideoEnoncesFr($qcmVideoEnoncesFr)
    {
        $this->qcmVideoEnoncesFr = $qcmVideoEnoncesFr;
    }
}
