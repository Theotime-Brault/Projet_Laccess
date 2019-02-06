<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\wordEn;

/**
 * qcmEn
 *
 * @ORM\Table(name="exerciseqcm_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmEnRepository")
 */
class qcmEn
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
     * @ORM\Column(name="soltuion", type="integer")
     */
    private $soltuion;

    /**
     * @var wordEn
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\wordEn", inversedBy="qcmsEn")
     */
    private $wordEn;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmEnonceEn", mappedBy="qcmEn", cascade={"persist", "remove"})
     */
    private $qcmEnoncesEn;

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
     * @return qcmEn
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
     * Set soltuion
     *
     * @param integer $soltuion
     *
     * @return qcmEn
     */
    public function setSoltuion($soltuion)
    {
        $this->soltuion = $soltuion;

        return $this;
    }

    /**
     * Get soltuion
     *
     * @return int
     */
    public function getSoltuion()
    {
        return $this->soltuion;
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
    public function getQcmEnoncesEn()
    {
        return $this->qcmEnoncesEn;
    }

    /**
     * @param PersistentCollection $qcmEnoncesEn
     */
    public function setQcmEnoncesEn($qcmEnoncesEn)
    {
        $this->qcmEnoncesEn = $qcmEnoncesEn;
    }
}

