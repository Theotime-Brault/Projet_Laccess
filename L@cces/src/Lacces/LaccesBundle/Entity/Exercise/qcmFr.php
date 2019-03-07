<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordFr;

/**
 * qcmFr
 *
 * @ORM\Table(name="exerciseqcm_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmFrRepository")
 */
class qcmFr
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\Column(name="solution", type="integer", nullable=true)
     */
    private $solution;

    /**
     * @var wordFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", inversedBy="qcmsFr")
     */
    private $wordFr;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmEnonceFr", mappedBy="qcmFr", cascade={"persist", "remove"})
     */
    private $qcmEnoncesFr;

    /**
     * qcmFr constructor.
     * @param string $question
     * @param wordFr $wordFr
     */
    public function __construct($question, wordFr $wordFr)
    {
        $this->question = $question;
        $this->wordFr = $wordFr;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return qcmFr
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set solution
     *
     * @param integer $solution
     *
     * @return qcmFr
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * Get solution
     *
     * @return int
     */
    public function getSolution()
    {
        return $this->solution;
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
    public function getQcmEnoncesFr()
    {
        return $this->qcmEnoncesFr;
    }

    /**
     * @param PersistentCollection $qcmEnoncesFr
     */
    public function setQcmEnoncesFr($qcmEnoncesFr)
    {
        $this->qcmEnoncesFr = $qcmEnoncesFr;
    }
}

