<?php

namespace Lacces\LaccesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * user
 *
 * @ORM\Table(name="Logos")
 * @ORM\Entity(repositoryClass="Lacces\LaccesBundle\Repository\logoRepository")
 */
class Logo
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
  * @ORM\Column(type="string")
  *
  * @Assert\NotBlank(message="Ajouter une image jpg ou png")
  * @Assert\File(
   *   mimeTypes={"image/jpeg", "image/png", "image/gif"},
   *   mimeTypesMessage = "Veuillez insérer une image valide (png, jpeg, gif)")
  */
  private $image;

  /**
   * @ORM\Column(type="string")
   */
  private $nomImage;

  public function getImage()
  {
    return $this->image;
  }

  public function setImage($image)
  {
    $this->image = $image;

    return $this;
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getNomImage()
  {
    return $this->nomImage;
  }

  /**
   * @param mixed $nomImage
   */
  public function setNomImage($nomImage)
  {
    $this->nomImage = $nomImage;
  }
}