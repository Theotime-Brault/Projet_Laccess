<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Lacces\LaccesBundle\Entity\wordFr;

/**
 * significationVideoFr
 *
 * @ORM\Table(name="exercisesignification_video_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\significationVideoFrRepository")
 */
class significationVideoFr
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
     * @var wordFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", inversedBy="significationsVideoFr")
     */
    private $wordFr;

    /**
     * significationVideoFr constructor.
     * @param string $solution
     * @param string $videoLink
     * @param wordFr $wordFr
     */
    public function __construct($solution, $videoLink, wordFr $wordFr)
    {
        $this->solution = $solution;
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
     * @return significationVideoFr
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
     * @return significationVideoFr
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
}
