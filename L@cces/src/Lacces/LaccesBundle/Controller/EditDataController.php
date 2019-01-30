<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\FormData;
use Lacces\LaccesBundle\Entity\traductionFrEn;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Entity\wordFr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

      $form = $this->createFormBuilder($formulaire)

        //MOT FRANCAIS

        ->add('wordFr', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescriptionFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))

        //MOT ANGLAIS

        ->add('wordEn', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescriptionEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))

        //VALIDATION

        ->add('submit', SubmitType::class, array(
          'label' => 'Envoyer',
          'attr' => array(
            'class' => "btn btn-contact background-color-orange-lacces waves-effect",
          )))
        ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $formulaire = $form->getData();
        $this->addFlash('info', "Le mot à bien été crée !");

        $traduction = new traductionFrEn();
        $monMotFr = new wordFr();
        $monMotEn = new wordEn();

        $monMotFr->setWord($formulaire->getWordFr());
        $monMotFr->setVideoLink($formulaire->getVideoLinkFr());
        $monMotFr->setContextSentence($formulaire->getContextSentenceFr());
        $monMotFr->setVideoDescription($formulaire->getVideoDescriptionFr());
        $monMotFr->setPopularity(0);

        $traduction->setWordFr($monMotFr);

        $monMotEn->setWord($formulaire->getWordEn());
        $monMotEn->setVideoLink($formulaire->getVideoLinkEn());
        $monMotEn->setContextSentence($formulaire->getContextSentenceEn());
        $monMotEn->setVideoDescription($formulaire->getVideoDescriptionEn());
        $monMotEn->setPopularity(0);

        $traduction->setWordEn($monMotEn);

        $em = $this->getDoctrine()->getManager();
        $em->persist($monMotFr);
        $em->persist($monMotEn);
        $em->persist($traduction);

        $em->flush();

        return $this->render('@Lacces/EditData/addData.html.twig', array(
          'form' => $form->createView(),
        ));
      }
      return $this->render('@Lacces/EditData/addData.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function removeAction() {
        return $this->render('@Lacces/EditData/removeData.html.twig');
    }

}
