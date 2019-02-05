<?php

namespace Lacces\LaccesBundle\Entity\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class Form
{
    /**
     * @Assert\NotBlank
     */
    protected $nom;

    /**
     * @Assert\NotBlank
     */
    protected $prenom;

    /**
     * @Assert\NotBlank
     */
    protected $message;

    /**
     * @Assert\NotBlank
     */
    protected $Email;

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $adresse
     */
    public function setEmail($adresse)
    {
        $this->Email = $adresse;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }



    }