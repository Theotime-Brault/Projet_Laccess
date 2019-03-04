<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExerciceController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function exercicesAction($langue)
  {

    if($langue == "fr" || $langue == "en") {

      $em = $this->getDoctrine()->getManager();

      $motAlea = $this->motAleatoire($langue);
      $motAleaId = $motAlea->getId();

      $question = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findByWordEn($motAleaId);

      //NE DOIS NORMALEMENT JAMAIS ARRIVER
      if(!$motAlea){
        $this->addFlash('info', "Le mot rechercher n'existe pas.");
        return $this->redirectToRoute('lacces_homepage');
      }

      return $this->render('@Lacces/Exercices/exercices.html.twig', array(
        'word' => $motAlea->getWord(),
        'question' => $question[0]->getQuestion(),
        'langue' => $langue,
      ));
    }

    return $this->redirectToRoute('lacces_homepage');

  }

  public function motAleatoire($langue) {

    $em = $this->getDoctrine()->getManager();

    /*if($langue == "fr") {
      $mots = $em->getRepository('LaccesBundle:wordFr')->findAll();
    } else {
      $mots = $em->getRepository('LaccesBundle:wordEn')->findAll();
    }

    $idAlea = rand($mots[0]->getId(), sizeof($mots));

    if($langue == "fr") {
      //$motAlea = $em->getRepository('LaccesBundle:wordFr')->find($idAlea);
    } else {
      //$motAlea = $em->getRepository('LaccesBundle:wordEn')->find($idAlea);
    }
    */

    if($langue == "fr") {
      $tabMotAlea = $em->getRepository('LaccesBundle:wordFr')->findAlea();
    } else {
      $tabMotAlea = $em->getRepository('LaccesBundle:wordEn')->findAlea();
    }

    shuffle($tabMotAlea);
    $motAlea = $tabMotAlea[0];

    return $motAlea;
  }
}