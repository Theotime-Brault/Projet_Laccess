<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;

/**
 * qcmEnonceFr
 *
 * @ORM\Table(name="exerciseqcm_enonce_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmEnonceFrRepository")
 */
class qcmEnonceFr
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
     * @ORM\Column(name="enonces", type="string", length=255)
     */
    private $enonces;

    /**
     * @var qcmFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmFr", inversedBy="qcmEnoncesFr")
     */
    private $qcmFr;

    /**
     * qcmEnonceFr constructor.
     * @param string $enonces
     * @param qcmFr $qcmFr
     */
    public function __construct($enonces, qcmFr $qcmFr)
    {
        $this->enonces = $enonces;
        $this->qcmFr = $qcmFr;
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
     * Set enonces
     *
     * @param string $enonces
     *
     * @return qcmEnonceFr
     */
    public function setEnonces($enonces)
    {
        $this->enonces = $enonces;

        return $this;
    }

    /**
     * Get enonces
     *
     * @return string
     */
    public function getEnonces()
    {
        return $this->enonces;
    }

    /**
     * @return qcmFr
     */
    public function getQcmFr()
    {
        return $this->qcmFr;
    }

    /**
     * @param qcmFr $qcmFr
     */
    public function setQcmFr($qcmFr)
    {
        $this->qcmFr = $qcmFr;
    }
}

