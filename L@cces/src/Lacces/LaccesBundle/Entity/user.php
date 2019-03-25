<?php

namespace Lacces\LaccesBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * user
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\userRepository")
 */
class user implements AdvancedUserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=30, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, unique=true)
     */
      private $email;



    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
      private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=64)
     */
    private $roles;


    public function __construct()
    {
      $this->isActive = true;
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
     * Set username
     *
     * @param string $username
     *
     * @return user
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
      return null;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return user
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return user
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles()
    {
        return array($this->roles);
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
      return serialize(array(
        $this->id,
        $this->username,
        $this->password,
        $this->isActive
      ));
    }

    public function unserialize($serialized)
    {
      list (
        $this->id,
        $this->username,
        $this->password,
        $this->isActive
        ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
      return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
      $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
      return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive)
    {
      $this->isActive = $isActive;
    }

    public function isAccountNonExpired()
    {
      return true;
    }

    public function isAccountNonLocked()
    {
      return true;
    }

    public function isCredentialsNonExpired()
    {
      return true;
    }

    public function isEnabled()
    {
      return $this->isActive;
    }
}

