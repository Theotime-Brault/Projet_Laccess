<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Exercise\significationVideoEn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ExerciceController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function exercicesAction($langue)
  {
      $em = $this->getDoctrine()->getManager();
      $logo = $em->getRepository('LaccesBundle:Logo')->find(1);

      return $this->render('@Lacces/Exercices/exercices.html.twig', array(
        'langue' => $langue,
        'logo' => $logo
      ));
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

          //On initialise notre exercice à null
          $obj_exerciceA1 = null;

          //Si il est toujours null apres ce bout de code on boucle jusqu'à ce qu'il ne le soit plus
          do {

            //Récupération d'un mot aléatoirement
            $motAlea = $this->motAleatoire($langue);
            $motAleaId = $motAlea->getId();

            //NE DOIS NORMALEMENT JAMAIS ARRIVER
            if (!$motAlea) {
              $this->addFlash('info', "Le mot rechercher n'existe pas.");
              return $this->redirectToRoute('lacces_homepage');
            }

            //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
            if ($langue == "en") {

              //Récupération de l'id des exercices qui utilisent l'id du mot aléatoire
              $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findByWordEnId($motAleaId);

              //Si il y a plusieurs exercices
              if(sizeof($obj_exerciceA1Id) != 0) {

                //On randomise le tableau qu'on obtient (on peut avoir plusieurs exercices)
                $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);

                //On récupère l'objet de l'exercice choisi aléatoirement
                $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->find($obj_exerciceA1Id[$idRandom]);

              }
            } else {

              //On fait la même chose pour les mots en français
              $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->findByWordFrId($motAleaId);

              if(sizeof($obj_exerciceA1Id) != 0) {
                $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);
                $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->find($obj_exerciceA1Id[$idRandom]);
              }
            }
          } while($obj_exerciceA1 == null);

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

      $em = $this->getDoctrine()->getManager();

      $obj_exerciceFrA2 = null;
      $obj_exerciceEnA2 = null;

      do {

        $motAleaFr = $this->motAleatoire("fr");
        $motAleaFrId = $motAleaFr->getId();

        $motAleaEnTab = $motAleaFr->getWordEns();
        $motAleaEn = $motAleaEnTab[0];
        $motAleaEnId = $motAleaEn->getId();


        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if(!$motAleaFr || !$motAleaEn){
          $this->addFlash('info', "Le mot rechercher n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }


        //Recupération mot anglais
        $obj_exerciceEnA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->findByWordEnId($motAleaEnId);
        $obj_exerciceFrA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->findByWordFrId($motAleaFrId);

        if(sizeof($obj_exerciceEnA2Id) != 0 && sizeof($obj_exerciceFrA2Id) != 0) {
          $idRandom = rand(0, sizeof($obj_exerciceEnA2Id) - 1);
          $obj_exerciceEnA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->find($obj_exerciceEnA2Id[$idRandom]);

          //Recupération mot français
          $idRandom = rand(0, sizeof($obj_exerciceFrA2Id) - 1);
          $obj_exerciceFrA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->find($obj_exerciceFrA2Id[$idRandom]);
        }
      } while ($obj_exerciceEnA2 == null && $obj_exerciceFrA2 == null);

      if($request->isXmlHttpRequest()){
        $render =  $this->renderView('@Lacces/Exercices/Types/exerciceA2.html.twig', array(
          'wordFr' => $motAleaFr->getWord(),
          'wordEn' => $motAleaEn->getWord(),
          'obj_exerciceFrA2' => $obj_exerciceFrA2,
          'obj_exerciceEnA2' => $obj_exerciceEnA2,
        ));
        return new JsonResponse($render);
      }else {
        return $this->redirectToRoute('lacces_homepage');
      }
    }

    public function exerciceBAction(Request $request) {

      $langue = $request->get('langue');

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $obj_exerciceB = null;

        do {
          $motAlea = $this->motAleatoire($langue);
          $motAleaId = $motAlea->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$motAlea) {
            $this->addFlash('info', "Le mot rechercher n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
          if($langue == "en") {

            //Recupération de ou des id des exercices correspondant au mot aléatoire
            $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmEn')->findByWordEnId($motAleaId);

            if(sizeof($obj_exerciceBId) != 0) {
              //On en choisi un au hasard
              $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);

              //On récupère l'exercice
              $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmEn')->find($obj_exerciceBId[$idRandom]);

              //On récupère les id des réponses correspondant à l'exercice
              $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceEn')->findByQcmEnId($obj_exerciceB->getId());
            }
          } else {

            //Meme opération pour les mots en français

            $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmFr')->findByWordFrId($motAleaId);

            if(sizeof($obj_exerciceBId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);
              $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmFr')->find($obj_exerciceBId[$idRandom]);
              $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceFr')->findByQcmFrId(/*$obj_exerciceBId*/$obj_exerciceB->getId());
            }
          }
        } while($obj_exerciceB == null);

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceB.html.twig', array(
            'word' => $motAlea->getWord(),
            'obj_exerciceB' => $obj_exerciceB,
            'tableauReponses' => $obj_reponseB
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

        $obj_exerciceC = null;

        do {
          $motAlea = $this->motAleatoire($langue);
          $motAleaId = $motAlea->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$motAlea) {
            $this->addFlash('info', "Le mot rechercher n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          //Même principe que l'exercice B

          if($langue == "en") {
            $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->findByWordEnId($motAleaId);

            if(sizeof($obj_exerciceCId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
              $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->find($obj_exerciceCId[$idRandom]);
              $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoEn')->findByQcmVideoEnId($obj_exerciceC->getId());
            }
          } else {
            $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->findByWordFrId($motAleaId);

            if(sizeof($obj_exerciceCId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
              $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->find($obj_exerciceCId[$idRandom]);
              $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoFr')->findByQcmVideoFrId($obj_exerciceC->getId());
            }
          }
        } while ($obj_exerciceC == null);

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

        $obj_exerciceD = null;

        do {
          $motAlea = $this->motAleatoire($langue);
          $motAleaId = $motAlea->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$motAlea) {
            $this->addFlash('info', "Le mot rechercher n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          if($langue == "en") {
            $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->findByWordEnId($motAleaId);

            if(sizeof($obj_exerciceDId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
              $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->find($obj_exerciceDId[$idRandom]);
            }
          }
          else {
            $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->findByWordFrId($motAleaId);

            if(sizeof($obj_exerciceDId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
              $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->find($obj_exerciceDId[$idRandom]);
            }
          }
        } while ($obj_exerciceD == null);



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