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

    if($langue == "fr") {

      return $this->redirectToRoute('lacces_exercices', array(
        'langue' => $langue,
        'word' => $word
      ));

    } else if ($langue == "en") {

    }

    return $this->redirectToRoute('lacces_homepage');

  }
}