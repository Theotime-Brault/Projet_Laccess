<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\FormData;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Entity\wordFr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class EditDataController extends Controller
{
    public function editAction() {
        return $this->render('@Lacces/EditData/editData.html.twig');
    }

  /**
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
    public function addAction(Request $request) {

      $formulaire = new FormData();
      $choices = [
        'En' => 'En',
        'Fr' => 'Fr',
      ];


      $form = $this->createFormBuilder($formulaire)
        ->add('langue', ChoiceType::class, array(
          'label' => 'Langue : ',
          'choices' => $choices,
          'invalid_message' => '"{{ value }}" is not valid. Valid choices: {{ choices }}.',
          'invalid_message_parameters' => [
            '{{ choices }}' => implode(', ', $choices),
          ],
        ))
        ->add('word', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLink', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentence', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescription', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('submit', SubmitType::class, array(
          'label' => 'Envoyer',
          'attr' => array(
            'class' => "btn btn-contact background-color-orange-lacces waves-effect",
          )))
        ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $formulaire = $form->getData();
        $this->addFlash('info', "Le mot à bien été ajouté !");


        if($formulaire->getLangue() == 'Fr') {
          $monMot = new wordFr();
        } else {
          $monMot = new wordEn();
        }

        $monMot->setWord($formulaire->getWord());
        $monMot->setVideoLink($formulaire->getVideoLink());
        $monMot->setContextSentence($formulaire->getContextSentence());
        $monMot->setVideoDescription($formulaire->getVideoDescription());
        $monMot->setPopularity(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($monMot);
        $em->flush();

        return $this->redirectToRoute('lacces_homepage');
      }
      return $this->render('@Lacces/EditData/addData.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function removeAction() {
        return $this->render('@Lacces/EditData/removeData.html.twig');
    }

}
