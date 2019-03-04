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
      $langue = $request->request->get('langue');

        if($langue == "fr" || $langue == "en") {

            $em = $this->getDoctrine()->getManager();

            $motAlea = $this->motAleatoire($langue);
            $motAleaId = $motAlea->getId();

            $obj_exerciceA1Id = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findByWordEnId($motAleaId);
            $idRandom = rand(0, sizeof($obj_exerciceA1Id) - 1);
            $obj_exerciceA1 = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->find($obj_exerciceA1Id[$idRandom]);

            //NE DOIS NORMALEMENT JAMAIS ARRIVER
            if(!$motAlea){
                $this->addFlash('info', "Le mot rechercher n'existe pas.");
                return $this->redirectToRoute('lacces_homepage');
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

    public function exerciceBAction() {

      $em = $this->getDoctrine()->getManager();

      $exerciceB = $em->getRepository('LaccesBundle:Exercise\qcmEn')->findByWordEn();

      return $this->renderView('@Lacces/Exercices/Types/exerciceA1.html.twig');
    }
}