<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordEn;

/**
 * qcmVideoEn
 *
 * @ORM\Table(name="exerciseqcm_video_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmVideoEnRepository")
 */
class qcmVideoEn
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
     * @var wordEn
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="qcmsVideoEn")
     */
    private $wordEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmEnonceVideoEn", mappedBy="qcmVideoEn", cascade={"persist", "remove"})
     */
    private $qcmVideoEnoncesEn;

    /**
     * qcmVideoEn constructor.
     * @param string $videoLink
     * @param wordEn $wordEn
     */
    public function __construct($videoLink, wordEn $wordEn)
    {
        $this->videoLink = $videoLink;
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
     * Set solution.
     *
     * @param integer $solution
     *
     * @return qcmVideoEn
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
     * @param string $videoLink
     *
     * @return qcmVideoEn
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
     * @return PersistentCollection
     */
    public function getQcmVideoEnoncesEn()
    {
        return $this->qcmVideoEnoncesEn;
    }

    /**
     * @param PersistentCollection $qcmVideoEnoncesEn
     */
    public function setQcmVideoEnoncesEn($qcmVideoEnoncesEn)
    {
        $this->qcmVideoEnoncesEn = $qcmVideoEnoncesEn;
    }
}
