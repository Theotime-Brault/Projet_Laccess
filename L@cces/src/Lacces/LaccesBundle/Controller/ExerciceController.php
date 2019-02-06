<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExerciceController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function exercicesAction($word, $langue)
  {

    if($langue == "fr" || $langue == "en") {

      $em = $this->getDoctrine()->getManager();

      if($langue == "fr"){
        $objWord = $em->getRepository('LaccesBundle:wordFr')->findByWord($word);
      }else {
        $objWord = $em->getRepository('LaccesBundle:wordEn')->findByWord($word);
      }

      if(!$objWord){
        $this->addFlash('info', "Le mot rechercher n'existe pas.");
        return $this->redirectToRoute('lacces_homepage');
      }

      return $this->redirectToRoute('lacces_exercices', array(
        'langue' => $langue,
        'word' => $word
      ));
    }

    return $this->redirectToRoute('lacces_homepage');

  }
}