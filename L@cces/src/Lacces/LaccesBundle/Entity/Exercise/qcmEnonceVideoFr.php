<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;

/**
 * qcmEnonceVideoFr
 *
 * @ORM\Table(name="exerciseqcm_enonce_video_fr")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmEnonceVideoFrRepository")
 */
class qcmEnonceVideoFr
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
     * @var qcmVideoFr
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmVideoFr", inversedBy="qcmVideoEnoncesFr")
     */
    private $qcmVideoFr;

    /**
     * qcmEnonceVideoFr constructor.
     * @param string $enonces
     * @param qcmVideoFr $qcmVideoFr
     */
    public function __construct($enonces, qcmVideoFr $qcmVideoFr)
    {
        $this->enonces = $enonces;
        $this->qcmVideoFr = $qcmVideoFr;
    }


    /**
     * @return qcmVideoFr
     */
    public function getQcmVideoFr()
    {
        return $this->qcmVideoFr;
    }

    /**
     * @param qcmVideoFr $qcmVideoFr
     */
    public function setQcmVideoFr($qcmVideoFr)
    {
        $this->qcmVideoFr = $qcmVideoFr;
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
     * Set enonces.
     *
     * @param string $enonces
     *
     * @return qcmEnonceVideoFr
     */
    public function setEnonces($enonces)
    {
        $this->enonces = $enonces;

        return $this;
    }

    /**
     * Get enonces.
     *
     * @return string
     */
    public function getEnonces()
    {
        return $this->enonces;
    }
}
