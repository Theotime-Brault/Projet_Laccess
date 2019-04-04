<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Exercise\significationVideoEn;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Entity\wordFr;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

//--------------A supprimé pour activation du site-------------
/**
 * @IsGranted("ROLE_ADMIN")
 */
//-------------------------------------------------------------

class ExerciceController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function exercicesAction($langue, $wordId)
  {
      $em = $this->getDoctrine()->getManager();


      //ON RECUPERE L'ID DU MOTS "FR" ET "EN" RECHERCHÉ AFIN DE POUVOIR PLUS TARD SWITCHER LA LANGUE EN GARDANT L'ID QUI CORRESPOND
      //EXEMPLE:  MotFr = "Canard" (id = 5)    MotEn = "Duck" (id = 12)
      //JE SUIS EN FRANCAIS ET DONC wordID = 5
      //SI JE CHANGE LA LANGUE wordId DEVIENDRA "12"


    $wordFr = new wordFr();
    $wordEn = new wordEn();

    // On vérifie si l'utilisateur cherche un exercice avec un mot aléatoire ou non
    if($wordId != 0) {

      if($langue == "fr") {
        $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
        if(!$wordFr) {
          $this->addFlash('info', "Le mot recherché n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }
        $wordEnTab = $wordFr->getWordEns();
        $wordEn = $wordEnTab[0];
      }

      else {
        $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
        if(!$wordEn) {
          $this->addFlash('info', "Le mot recherché n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }
        $wordFrTab = $wordEn->getWordFrs();
        $wordFr = $wordFrTab[0];
      }
    }

    $wordFrId = $wordFr->getId();
    $wordEnId = $wordEn->getId();

      return $this->render('@Lacces/Exercices/exercices.html.twig', array(
        'langue' => $langue,
        'wordId' => $wordId,
        'wordFrId' => $wordFrId,
        'wordEnId' => $wordEnId
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

    public function exerciceA1Action(Request $request, $wordId)
    {
      $langue = $request->get('langue');
      $messageErreur = "L'exercice recherché n'existe pas";

        if($langue == "fr" || $langue == "en") {

          $em = $this->getDoctrine()->getManager();

          //On initialise notre exercice à null
          $obj_exerciceA1 = null;

          //Si il est toujours null apres le bout de code suivant, on boucle jusqu'à ce qu'il ne le soit plus
          do {

            //Récupération d'un mot aléatoirement pour la page Exercice
            if($wordId == 0) {
              $mot = $this->motAleatoire($langue);
            }
            //Pour la page de traduction du mot, l'onglet exercice doit correspondre au mot cherché
            else {
              if($langue == "fr") {
                $mot = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
              } else {
                $mot = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
              }
            }

            $motId = $mot->getId();

            //NE DOIS NORMALEMENT JAMAIS ARRIVER
            if (!$mot) {
              $this->addFlash('info', "Le mot rechercher n'existe pas.");
              return $this->redirectToRoute('lacces_homepage');
            }

            //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
            if ($langue == "en") {

              //Récupération de l'id des exercices qui utilisent l'id du mot aléatoire
              $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findByWordEnId($motId);

              //Si il y a plusieurs exercices
              if(sizeof($obj_exerciceA1Id) != 0) {

                //On randomise le tableau qu'on obtient (on peut avoir plusieurs exercices)
                $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);

                //On récupère l'objet de l'exercice choisi aléatoirement
                $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->find($obj_exerciceA1Id[$idRandom]);

              }
            } else {

              //On fait la même chose pour les mots en français
              $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->findByWordFrId($motId);

              if (sizeof($obj_exerciceA1Id) != 0) {
                $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);
                $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->find($obj_exerciceA1Id[$idRandom]);
              }
            }
          } while($obj_exerciceA1 == null && $wordId == 0);

          if(!$obj_exerciceA1) {
            $solution = null;
          } else {
            $solution = $obj_exerciceA1->getSolution();
          }

          if($request->isXmlHttpRequest()){
            $render =  $this->renderView('@Lacces/Exercices/Types/exerciceA1.html.twig', array(
              'word' => $mot->getWord(),
              'obj_exerciceA1' => $obj_exerciceA1,
              'messageErreur' => $messageErreur,
              'solution' => $solution
            ));
            return new JsonResponse($render);
          }else{
            return $this->redirectToRoute('lacces_homepage');
          }
        }
    }

    public function exerciceA2Action(Request $request, $wordId) {

      $em = $this->getDoctrine()->getManager();
      $messageErreur = "L'exercice recherché n'existe pas";

      $obj_exerciceFrA2 = null;
      $obj_exerciceEnA2 = null;

      do {

        //Récupération d'un mot aléatoirement
        if($wordId == 0) {
          $motFr = $this->motAleatoire("fr");
        }
        //Pour la page du mot, l'exercice doit correspondre au mot cherché
        else {
          $motFr = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
        }

        $motFrId = $motFr->getId();

        //Récupération des mots traduction du mot français
        $motEnTab = $motFr->getWordEns();
        $motEn = $motEnTab[0];
        $motEnId = $motEn->getId();


        //NE DOIS NORMALEMENT JAMAIS ARRIVER
        if(!$motFr || !$motEn){
          $this->addFlash('info', "Le mot recherché n'existe pas.");
          return $this->redirectToRoute('lacces_homepage');
        }


        //Recupération mot anglais
        $obj_exerciceEnA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->findByWordEnId($motEnId);
        $obj_exerciceFrA2Id = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->findByWordFrId($motFrId);

        if(sizeof($obj_exerciceEnA2Id) != 0 && sizeof($obj_exerciceFrA2Id) != 0) {
          $idRandom = rand(0, sizeof($obj_exerciceEnA2Id) - 1);
          $obj_exerciceEnA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->find($obj_exerciceEnA2Id[$idRandom]);

          //Recupération mot français
          $idRandom = rand(0, sizeof($obj_exerciceFrA2Id) - 1);
          $obj_exerciceFrA2 = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->find($obj_exerciceFrA2Id[$idRandom]);
        }
      } while (($obj_exerciceEnA2 == null && $wordId == 0) && ($obj_exerciceFrA2 == null && $wordId == 0));

      if($request->isXmlHttpRequest()){
        $render =  $this->renderView('@Lacces/Exercices/Types/exerciceA2.html.twig', array(
          'wordFr' => $motFr->getWord(),
          'wordEn' => $motEn->getWord(),
          'obj_exerciceFrA2' => $obj_exerciceFrA2,
          'obj_exerciceEnA2' => $obj_exerciceEnA2,
          'messageErreur' => $messageErreur,
        ));
        return new JsonResponse($render);
      }else {
        return $this->redirectToRoute('lacces_homepage');
      }
    }

    public function exerciceBAction(Request $request, $wordId) {

      $langue = $request->get('langue');
      $messageErreur = "L'exercice recherché n'existe pas";

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $obj_exerciceB = null;

        do {

          //Récupération d'un mot aléatoirement
          if($wordId == 0) {
            $mot = $this->motAleatoire($langue);
          }
          //Pour la page du mot, l'exercice doit correspondre au mot cherché
          else {
            if($langue == "fr") {
              $mot = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
            } else {
              $mot = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
            }
          }

          $motId = $mot->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$mot) {
            $this->addFlash('info', "Le mot recherché n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          //ON RECUPERE L'OBJET EXERCICE PAR RAPPORT AU MOT ALEATOIRE (FR ou EN)
          if($langue == "en") {

            //Recupération de ou des id des exercices correspondant au mot aléatoire
            $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmEn')->findByWordEnId($motId);

            if(sizeof($obj_exerciceBId) != 0) {
              //On en choisi un au hasard
              $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);

              //On récupère l'exercice
              $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmEn')->find($obj_exerciceBId[$idRandom]);

              //On récupère les id des réponses correspondant à l'exercice
              $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceEn')->findByQcmEnId($obj_exerciceB->getId());

              //On randomise le tableau de réponse pour ne pas avoir la réponse toujours en première position
              shuffle($obj_reponseB);

            }
          } else {

            //Meme opération pour les mots en français

            $obj_exerciceBId = $em->getRepository('LaccesBundle:Exercise\qcmFr')->findByWordFrId($motId);

            if(sizeof($obj_exerciceBId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceBId) - 1);
              $obj_exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmFr')->find($obj_exerciceBId[$idRandom]);
              $obj_reponseB = $em->getRepository('LaccesBundle:Exercise\qcmEnonceFr')->findByQcmFrId($obj_exerciceB->getId());
              shuffle($obj_reponseB);
            }
          }
        } while($obj_exerciceB == null && $wordId == 0);

        if(!$obj_exerciceB) {
          $solution = null;
          $obj_reponseB = null;
        } else {
          $solution = $obj_exerciceB->getSolution();
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceB.html.twig', array(
            'word' => $mot->getWord(),
            'obj_exerciceB' => $obj_exerciceB,
            'tableauReponses' => $obj_reponseB,
            'messageErreur' => $messageErreur,
            'solution' => $solution
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }

      return $this->renderView('@Lacces/Exercices/Types/exerciceB.html.twig');
    }

    public function exerciceCAction(Request $request, $wordId) {

      $langue = $request->get('langue');
      $messageErreur = "L'exercice recherché n'existe pas";

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $obj_exerciceC = null;

        do {

          //Récupération d'un mot aléatoirement
          if($wordId == 0) {
            $mot = $this->motAleatoire($langue);
          }
          //Pour la page du mot, l'exercice doit correspondre au mot cherché
          else {
            if($langue == "fr") {
              $mot = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
            } else {
              $mot = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
            }
          }

          $motId = $mot->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$mot) {
            $this->addFlash('info', "Le mot recherché n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          //Même principe que l'exercice B

          if($langue == "en") {
            $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->findByWordEnId($motId);

            if(sizeof($obj_exerciceCId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
              $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->find($obj_exerciceCId[$idRandom]);
              $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoEn')->findByQcmVideoEnId($obj_exerciceC->getId());
              shuffle($obj_reponseC);
            }
          } else {
            $obj_exerciceCId = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->findByWordFrId($motId);

            if(sizeof($obj_exerciceCId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceCId) - 1);
              $obj_exerciceC = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->find($obj_exerciceCId[$idRandom]);
              $obj_reponseC = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoFr')->findByQcmVideoFrId($obj_exerciceC->getId());
              shuffle($obj_reponseC);
            }
          }
        } while ($obj_exerciceC == null && $wordId == 0);

        if(!$obj_exerciceC) {
          $solution = null;
          $obj_reponseC = null;
        } else {
          $solution = $obj_exerciceC->getSolution();
        }

        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig', array(
            'word' => $mot->getWord(),
            'obj_exerciceC' => $obj_exerciceC,
            'tableauReponses' => $obj_reponseC,
            'messageErreur' => $messageErreur,
            'solution' => $solution
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }
      return $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig');
    }

    public function exerciceDAction(Request $request, $wordId) {
      $langue = $request->get('langue');
      $messageErreur = "L'exercice recherché n'existe pas";

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $obj_exerciceD = null;

        do {

          //Récupération d'un mot aléatoirement
          if($wordId == 0) {
            $mot = $this->motAleatoire($langue);
          }
          //Pour la page du mot, l'exercice doit correspondre au mot cherché
          else {
            if($langue == "fr") {
              $mot = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
            } else {
              $mot = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
            }
          }

          $motId = $mot->getId();

          //NE DOIS NORMALEMENT JAMAIS ARRIVER
          if (!$mot) {
            $this->addFlash('info', "Le mot recherché n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
          }

          if($langue == "en") {
            $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->findByWordEnId($motId);

            if(sizeof($obj_exerciceDId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
              $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->find($obj_exerciceDId[$idRandom]);
            }
          }
          else {
            $obj_exerciceDId = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->findByWordFrId($motId);

            if(sizeof($obj_exerciceDId) != 0) {
              $idRandom = rand(0, sizeof($obj_exerciceDId) - 1);
              $obj_exerciceD = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->find($obj_exerciceDId[$idRandom]);
            }
          }
        } while ($obj_exerciceD == null && $wordId == 0);

        if(!$obj_exerciceD) {
          $solution = null;
        } else {
          $solution = $obj_exerciceD->getSolution();
        };



        if($request->isXmlHttpRequest()){
          $render =  $this->renderView('@Lacces/Exercices/Types/exerciceD.html.twig', array(
            'word' => $mot->getWord(),
            'obj_exerciceD' => $obj_exerciceD,
            'messageErreur' => $messageErreur,
            'solution' => $solution
          ));
          return new JsonResponse($render);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }
      }
      return $this->renderView('@Lacces/Exercices/Types/exerciceC.html.twig');
    }
}