<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * traductionFrEn
 *
 * @ORM\Table(name="traduction_fr_en")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\traductionFrEnRepository")
 */
class traductionFrEn
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
     * @var int
     *
     * @ORM\Column(name="idFr", type="integer")
     */
    private $idFr;

    /**
     * @var int
     *
     * @ORM\Column(name="idEn", type="integer")
     */
    private $idEn;


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
     * Set idFr.
     *
     * @param int $idFr
     *
     * @return traductionFrEn
     */
    public function setIdFr($idFr)
    {
        $this->idFr = $idFr;

        return $this;
    }

    /**
     * Get idFr.
     *
     * @return int
     */
    public function getIdFr()
    {
        return $this->idFr;
    }

    /**
     * Set idEn.
     *
     * @param int $idEn
     *
     * @return traductionFrEn
     */
    public function setIdEn($idEn)
    {
        $this->idEn = $idEn;

        return $this;
    }

    /**
     * Get idEn.
     *
     * @return int
     */
    public function getIdEn()
    {
        return $this->idEn;
    }
}
