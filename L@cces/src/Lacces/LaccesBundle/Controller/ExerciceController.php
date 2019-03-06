<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ExerciceController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function exercicesAction()
  {
      return $this->render('@Lacces/Exercices/exercices.html.twig');
  }


    public function motAleatoire($langue)
    {

        $em = $this->getDoctrine()->getManager();

        if($langue == "fr") {
          $tabMotAlea = $em->getRepository('LaccesBundle:wordFr')->findAlea();
        } else {
          $tabMotAlea = $em->getRepository('LaccesBundle:wordEn')->findAlea();
        }

        shuffle($tabMotAlea);
        $motAlea = $tabMotAlea[0];

        return $motAlea;
    }

    public function exerciceA1Action(Request $request)
    {
      $langue = $request->get('langue');

        if($langue == "fr" || $langue == "en") {

          $em = $this->getDoctrine()->getManager();

          $motAlea = $this->motAleatoire($langue);
          $motAleaId = $motAlea->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if(!$motAlea){
            $this->addFlash('info', "Le mot rechercher n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
          if($langue == "en") {

            $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findByWordEnId($motAleaId);
            $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);
            $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->find($obj_exerciceA1Id[$idRandom]);
          } else {
            $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->findByWordFrId($motAleaId);
            $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);
            $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->find($obj_exerciceA1Id[$idRandom]);
          }

          if($request->isXmlHttpRequest()){
            $render =  $this->renderView('@Lacces/Exercices/Types/exerciceA1.html.twig', array(
              'word' => $motAlea->getWord(),
              'obj_exerciceA1' => $obj_exerciceA1,
            ));
            return new JsonResponse($render);
          }else{
            return $this->redirectToRoute('lacces_homepage');
          }
        }
    }

    public function exerciceA2Action(Request $request) {

      $langue = $request->get('langue');

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $motAlea = $this->motAleatoire($langue);
        $motAleaId = $motAlea->getId();

        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if(!$motAlea){
          $this->addFlash('info', "Le mot rechercher n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }

        //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
        if($langue == "en") {

          $obj_exerciceA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->findByWordEnId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceA2Id) - 1);
          $obj_exerciceA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->find($obj_exerciceA2Id[$idRandom]);
        } else {
          $obj_exerciceA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->findByWordFrId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceA2Id) - 1);
          $obj_exerciceA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->find($obj_exerciceA2Id[$idRandom]);
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceA2.html.twig', array(
            'word' => $motAlea->getWord(),
            'obj_exerciceA1' => $obj_exerciceA2,
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }
    }

    public function exerciceBAction(Request $request) {

      $langue = $request->get('langue');

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $motAlea = $this->motAleatoire($langue);
        $motAleaId = $motAlea->getId();

        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if (!$motAlea) {
          $this->addFlash('info', "Le mot rechercher n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }

        //Notre tableau qui contiendra nos réponse à l'exercice
        $tableauReponses = array();

        //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
        if($langue == "en") {

          //Recupération de ou des id des exercices correspondant au mot aléatoire
          $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmEn')->findByWordEnId($motAleaId);

          //On en choisi un au hasard
          $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);

          //On récupère l'exercice
          $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmEn')->find($obj_exerciceBId[$idRandom]);

          //On récupère les id des réponses correspondant à l'exercice
          $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceEn')->findByQcmFrId(/*$obj_exerciceBId*/$obj_exerciceB->getId());

          //Puis on ajoute chaque réponses dans un tableau
          /*foreach ($obj_reponseB as $value) {
            $reponse = $em->getRepository('LaccesBundle:Exercise\qcmEnonceEn')->find($value);
            array_push($tableauReponses, $reponse->getEnonces());
          }*/
        } else {

          //Meme opération pour les mots en français

          $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmFr')->findByWordFrId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);
          $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmFr')->find($obj_exerciceBId[$idRandom]);
          $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceFr')->findByQcmFrId(/*$obj_exerciceBId*/$obj_exerciceB->getId());

          /*foreach ($obj_reponseB as $value) {
              $reponse = $em->getRepository('LaccesBundle:Exercise\qcmEnonceFr')->find($value);
              array_push($tableauReponses, $reponse->getEnonces());
          }*/
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceB.html.twig', array(
            'word' => $motAlea->getWord(),
            'obj_exerciceB' => $obj_exerciceB,
            'tableauReponses' => $obj_reponseB /*$tableauReponses*/
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }

      return $this->renderView('@Lacces/Exercices/Types/exerciceB.html.twig');
    }

    public function exerciceCAction(Request $request) {

      $langue = $request->get('langue');

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $motAlea = $this->motAleatoire($langue);
        $motAleaId = $motAlea->getId();

        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if (!$motAlea) {
          $this->addFlash('info', "Le mot rechercher n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }

        //Notre tableau qui contiendra nos réponse à l'exercice
        $tableauReponses = array();


        //Même principe que l'exercice B

        if($langue == "en") {
          $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->findByWordEnId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
          $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->find($obj_exerciceCId[$idRandom]);
          $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoEn')->findByQcmVideoEnId($obj_exerciceC->getId());

          /*
          foreach ($obj_reponseCTableauId as $value) {
            $reponse = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoEn')->find($value);
            array_push($tableauReponses, $reponse->getEnonces());
          }*/

        } else {
          $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->findByWordFrId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
          $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->find($obj_exerciceCId[$idRandom]);
          $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoFr')->findByQcmVideoFrId($obj_exerciceC->getId());
/*
          foreach ($obj_reponseCTableauId as $value) {
            $reponse = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoFr')->find($value);
            array_push($tableauReponses, $reponse->getEnonces());
          }*/
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig', array(
            'word' => $motAlea->getWord(),
            'obj_exerciceC' => $obj_exerciceC,
            'tableauReponses' => $obj_reponseC
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }
      return $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig');
    }

    public function exerciceDAction(Request $request) {
      $langue = $request->get('langue');

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $motAlea = $this->motAleatoire($langue);
        $motAleaId = $motAlea->getId();

        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if (!$motAlea) {
          $this->addFlash('info', "Le mot rechercher n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }

        if($langue == "en") {
          $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->findByWordEnId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
          $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->find($obj_exerciceDId[$idRandom]);
        } else {
          $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->findByWordFrId($motAleaId);
          $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
          $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->find($obj_exerciceDId[$idRandom]);
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceD.html.twig', array(
            'word' => $motAlea->getWord(),
            'obj_exerciceD' => $obj_exerciceD
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }
      return $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig');
    }
}