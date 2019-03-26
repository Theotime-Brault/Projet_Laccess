<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Forms\LogoType;
use Lacces\LaccesBundle\Entity\Forms\userType;
use Lacces\LaccesBundle\Entity\user;
use Lacces\LaccesBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdministrationController extends Controller
{
  public function adminAction(Request $request, FileUploader $fileUploader)
  {
    $em = $this->getDoctrine()->getManager();

    $logo = $em->getRepository('LaccesBundle:Logo')->find(1);
    dump($logo);
    $form = $this->createForm(LogoType::class, $logo);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      // $file récupère le jpeg telechargé

      /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
      $file = $logo->getImage();
      $fileName = $fileUploader->upload($file);
      $logo->setImage($fileName);

      $em->persist($logo);
      $em->flush();

      return $this->redirect($this->generateUrl('administration'));
    }

    return $this->render("@Lacces/Administration/administration.html.twig", [
      'form' => $form->createView(),
      'logo' => $logo
    ]);
  }

  public function addAdminAction(Request $request, UserPasswordEncoderInterface $encoder) {

    $em = $this->getDoctrine()->getManager();

    $logo = $em->getRepository('LaccesBundle:Logo')->find(1);

    $newAdmin = new user();

    $form = $this->createForm(userType::class, $newAdmin);
    $form->add('submit', SubmitType::class, array(
      'label' => 'Créer l\'administrateur',
      'attr' => array(
        'class' => "btn btn-hover background-color-orange-lacces waves-effect",
      )));

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $formulaire = $form->getData();
      $this->addFlash('info', "L'administrateur a bien été créé !");

      $newAdmin->setUsername($formulaire->getUsername());
      $newAdmin->setPassword($encoder->encodePassword($newAdmin, $formulaire->getPassword()));
      $newAdmin->setRoles("ROLE_ADMIN");

      $em->persist($newAdmin);
      $em->flush();

      return $this->redirectToRoute('administration');

    }
    return $this->render("@Lacces/Administration/ajoutAdmin.html.twig", array(
      'form' => $form->createView(),
      'logo' => $logo
    ));
  }
}


