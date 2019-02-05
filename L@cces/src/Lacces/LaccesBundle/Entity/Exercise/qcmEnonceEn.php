<?php

namespace Lacces\LaccesBundle\Entity\Exercise;

use Doctrine\ORM\Mapping as ORM;

/**
 * qcmEnonceEn
 *
 * @ORM\Table(name="exerciseqcm_enonce_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\Exercise\qcmEnonceEnRepository")
 */
class qcmEnonceEn
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
     * @return qcmEnonceEn
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
}

