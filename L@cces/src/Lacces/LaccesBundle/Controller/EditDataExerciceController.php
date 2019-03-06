<?php
/**
 * Created by PhpStorm.
 * User: flo
 * Date: 07/02/19
 * Time: 15:12
 */

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Exercise\qcmEn;
use Lacces\LaccesBundle\Entity\Exercise\qcmEnonceEn;
use Lacces\LaccesBundle\Entity\Exercise\qcmVideoEn;
use Lacces\LaccesBundle\Entity\Exercise\reformulationEn;
use Lacces\LaccesBundle\Entity\Exercise\significationVideoEn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class EditDataExerciceController extends Controller
{
    public function exerciceAddEnAction(){
        //https://symfony.com/doc/current/form/dynamic_form_modification.html#form-events-submitted-data

        $em = $this->getDoctrine()->getManager();
        $words = $em->getRepository('LaccesBundle:wordEn')->findAll();

        return $this->render('@Lacces/Exercices/EditExercice/addExerciceEn.html.twig', array(
            'words' =>$words
        ));
    }

    public function exerciceAddFrAction(){
        $em = $this->getDoctrine()->getManager();
        $words = $em->getRepository('LaccesBundle:wordFr')->findAll();

        return $this->render('@Lacces/Exercices/EditExercice/addExerciceFr.html.twig', array(
            'words' =>$words
        ));
    }

    public function validExercice(Request $request){
        if ($request -> isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $ex = $request->request->get('ex');//defini le type d'exercice
            $langue = $request->request->get('langue');
            $solution = $request->request->get('solution');
            $word = $request->request->get('word');

            switch ($ex){
                case 1:
                    $videoLink = $request->request->get('videoLink');
                    if($langue == "en"){
                        $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($word);
                        $objEx = new significationVideoEn($solution, $videoLink, $wordEn);
                        $em->persist($objEx);
                        $em->flush();
                    }else{
                        $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);
                        $objEx = new significationVideoFr($solution, $videoLink, $wordFr);
                        $em->persist($objEx);
                        $em->flush();
                    }
                    break;
                case 2:
                    $enonce = $request->request->get('enonce');
                    $reponses = $request->request->get('otherRep');
                    $tabReponse = explode("_", $reponses);
                    if($langue == "en"){
                        $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($word);
                        $objEx = new qcmEn($enonce, $wordEn);
                        $em->persist($objEx);
                        $em->flush();
                        foreach ($tabReponse as $r){
                            $objRep = new qcmEnonceEn($r, $objEx);
                            //apres avoir persist recupere l'id du premier enonceè
                        }


                    }else{
                        $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);

                    }
                    break;
                case 3:
                    $videoLink = $request->request->get('videoLink');
                    $reponses = $request->request->get('otherRep');
                    $tabReponse = explode("_", $reponses);
                    if($langue == "en"){
                        $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($word);

                    }else{
                        $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);

                    }
                    break;
                case 4:
                    $enonce = $request->request->get('enonce');
                    if($langue == "en"){
                        $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($word);
                        $objEx = new reformulationEn($enonce, $solution, $wordEn);
                        $em->persist($objEx);
                        $em->flush();
                    }else{
                        $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);
                        $objEx = new reformulationFr($enonce, $solution, $wordFr);
                        $em->persist($objEx);
                        $em->flush();
                    }
                    break;
                default:
                    if($langue == "en"){
                        return $this->redirectToRoute('lacces_ex__en_add');
                    }else{
                        return $this->redirectToRoute('lacces_ex__fr_add');
                    }
                    break;
            }

            return new JsonResponse('ok');
        }
        return $this->redirectToRoute('administration');
    }
}