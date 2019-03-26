<?php

namespace Lacces\LaccesBundle\EventListener;

use Lacces\LaccesBundle\Entity\Logo;
use Lacces\LaccesBundle\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class BrochureUploadListener
{
  private $uploader;

  public function __construct(FileUploader $uploader)
  {
    $this->uploader = $uploader;
  }

  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();

    $this->uploadFile($entity);
  }

  public function preUpdate(PreUpdateEventArgs $args)
  {
    $entity = $args->getEntity();

    $this->uploadFile($entity);
  }

  private function uploadFile($entity)
  {
    // upload only works for Product entities
    if (!$entity instanceof Logo) {
      return;
    }

    $file = $entity->getImage();

    // only upload new files
    if ($file instanceof UploadedFile) {
      $fileName = $this->uploader->upload($file);
      $entity->setImage($fileName);
    } else if ($file instanceof File) {
      // prevents the full file path being saved on updates
      // as the path is set on the postLoad listener
      $entity->setImage($file->getFilename());
    }
  }

  public function postLoad(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();

    if (!$entity instanceof Logo) {
      return;
    }

    if ($fileName = $entity->getImage()) {
      $entity->setImage(new File($this->uploader->getTargetDirectory().'/'.$fileName));
    }
  }

}

