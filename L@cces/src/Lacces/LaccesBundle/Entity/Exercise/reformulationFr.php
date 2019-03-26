<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Lacces\LaccesBundle\Entity\wordFr;

/**
 * reformulationFr
 *
 * @ORM\Table(name="exercisereformulation_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\reformulationFrRepository")
 */
class reformulationFr
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
     * @var string
     *
     * @ORM\Column(name="solution", type="string", length=255)
     */
    private $solution;

    /**
     * @var wordFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordFr", inversedBy="reformulationsFr")
     */
    private $wordFr;

    /**
     * reformulationFr constructor.
     * @param string $question
     * @param string $solution
     * @param wordFr $wordFr
     */
    public function __construct($question, $solution, wordFr $wordFr)
    {
        $this->question = $question;
        $this->solution = $solution;
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
     * Set question.
     *
     * @param string $question
     *
     * @return reformulationFr
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set solution.
     *
     * @param string $solution
     *
     * @return reformulationFr
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
