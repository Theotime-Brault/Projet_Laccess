<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Forms\LogoType;
use Lacces\LaccesBundle\Entity\Forms\userType;
use Lacces\LaccesBundle\Entity\user;
use Lacces\LaccesBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdministrationController extends Controller
{
  public function adminAction(Request $request, FileUploader $fileUploader)
  {
    $em = $this->getDoctrine()->getManager();

    $users = $em->getRepository('LaccesBundle:user')->findAll();

    return $this->render("@Lacces/Administration/administration.html.twig", [
        'users' => $users
    ]);
  }

  public function addAdminAction(Request $request, UserPasswordEncoderInterface $encoder) {

    $em = $this->getDoctrine()->getManager();

    $newAdmin = new user();

    $form = $this->createForm(userType::class, $newAdmin);
    $form->add('submit', SubmitType::class, array(
      'label' => 'Ajouter',
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
    ));
  }

    public function helpAdminAction (){
        $em = $this->getDoctrine()->getManager();
        return $this->render("@Lacces/Administration/Help/helpAdmin.html.twig");
    }
}


