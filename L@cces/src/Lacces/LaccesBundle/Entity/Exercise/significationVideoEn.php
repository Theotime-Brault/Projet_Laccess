<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Lacces\LaccesBundle\Entity\wordEn;

/**
 * significationVideoEn
 *
 * @ORM\Table(name="exercisesignification_video_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\significationVideoEnRepository")
 */
class significationVideoEn
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
     * @ORM\Column(name="solution", type="string", length=255)
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
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="significationsVideoEn")
     */
    private $wordEn;

    /**
     * significationVideoEn constructor.
     * @param string $solution
     * @param string $videoLink
     * @param wordEn $wordEn
     */
    public function __construct($solution, $videoLink, wordEn $wordEn)
    {
        $this->solution = $solution;
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
     * @param string $solution
     *
     * @return significationVideoEn
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * Get solution.
     *
     * @return string
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
     * @return significationVideoEn
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
}
