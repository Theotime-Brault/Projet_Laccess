<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Lacces\LaccesBundle\Entity\wordEn;

/**
 * reformulationEn
 *
 * @ORM\Table(name="exercisereformulation_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\reformulationEnRepository")
 */
class reformulationEn
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
     * @var wordEn
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="reformulationsEn")
     */
    private $wordEn;

    /**
     * reformulationEn constructor.
     * @param string $question
     * @param string $solution
     * @param wordEn $wordEn
     */
    public function __construct($question, $solution, wordEn $wordEn)
    {
        $this->question = $question;
        $this->solution = $solution;
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
     * Set question.
     *
     * @param string $question
     *
     * @return reformulationEn
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
     * @return reformulationEn
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
