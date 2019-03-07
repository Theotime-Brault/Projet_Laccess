<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;

/**
 * qcmEnonceVideoEn
 *
 * @ORM\Table(name="exerciseqcm_enonce_video_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmEnonceVideoEnRepository")
 */
class qcmEnonceVideoEn
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
     * @var qcmVideoEn
     * @ORM\ManyToOne(targetEntity="Lacces\LaccesBundle\Entity\Exercise\qcmVideoEn", inversedBy="qcmVideoEnoncesEn")
     */
    private $qcmVideoEn;

    /**
     * qcmEnonceVideoEn constructor.
     * @param string $enonces
     * @param qcmVideoEn $qcmVideoEn
     */
    public function __construct($enonces, qcmVideoEn $qcmVideoEn)
    {
        $this->enonces = $enonces;
        $this->qcmVideoEn = $qcmVideoEn;
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
     * @return qcmEnonceVideoEn
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

    /**
     * @return qcmVideoEn
     */
    public function getQcmVideoEn()
    {
        return $this->qcmVideoEn;
    }

    /**
     * @param qcmVideoEn $qcmVideoEn
     */
    public function setQcmVideoEn($qcmVideoEn)
    {
        $this->qcmVideoEn = $qcmVideoEn;
    }
}
