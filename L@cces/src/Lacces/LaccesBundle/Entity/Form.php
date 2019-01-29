<?php

namespace Lacces\LaccesBundle\Entity;

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
     * @Assert\Choice(choices={"Fr", "En"})
     */
    protected $langue;

    /**
     * @Assert\NotBlank
     */
    protected $word;

    /**
     * @Assert\NotBlank
     */
    protected $videoLink;

    /**
     * @Assert\NotBlank
     */
    protected $contextSentence;

    /**
     * @Assert\NotBlank
     */
    protected $videoDescription;

  /**
   * @return mixed
   */
  public function getLangue()
  {
    return $this->langue;
  }

  /**
   * @param mixed $langue
   */
  public function setLangue($langue)
  {
    $this->langue = $langue;
  }

  /**
   * @return mixed
   */
  public function getWord()
  {
    return $this->word;
  }

  /**
   * @param mixed $word
   */
  public function setWord($word)
  {
    $this->word = $word;
  }

  /**
   * @return mixed
   */
  public function getVideoLink()
  {
    return $this->videoLink;
  }

  /**
   * @param mixed $videoLink
   */
  public function setVideoLink($videoLink)
  {
    $this->videoLink = $videoLink;
  }

  /**
   * @return mixed
   */
  public function getContextSentence()
  {
    return $this->contextSentence;
  }

  /**
   * @param mixed $contextSentence
   */
  public function setContextSentence($contextSentence)
  {
    $this->contextSentence = $contextSentence;
  }

  /**
   * @return mixed
   */
  public function getVideoDescription()
  {
    return $this->videoDescription;
  }

  /**
   * @param mixed $videoDescription
   */
  public function setVideoDescription($videoDescription)
  {
    $this->videoDescription = $videoDescription;
  }

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