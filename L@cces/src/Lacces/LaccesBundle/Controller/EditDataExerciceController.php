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
use Lacces\LaccesBundle\Entity\Exercise\qcmEnonceFr;
use Lacces\LaccesBundle\Entity\Exercise\qcmEnonceVideoEn;
use Lacces\LaccesBundle\Entity\Exercise\qcmEnonceVideoFr;
use Lacces\LaccesBundle\Entity\Exercise\qcmFr;
use Lacces\LaccesBundle\Entity\Exercise\qcmVideoEn;
use Lacces\LaccesBundle\Entity\Exercise\qcmVideoFr;
use Lacces\LaccesBundle\Entity\Exercise\reformulationEn;
use Lacces\LaccesBundle\Entity\Exercise\significationVideoEn;
use Lacces\LaccesBundle\Entity\Exercise\significationVideoFr;
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
            'words' => $words
        ));
    }

    public function validExerciceAction(Request $request){
        if ($request -> isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $ex = $request->request->get('ex');//defini le type d'exercice
            $langue = $request->request->get('langue');
            $solution = $request->request->get('solution');
            $word = $request->request->get('word');

            if($ex != null && $langue != null && $solution != null && $word != null){
                switch ($ex){

                    case '1':
                        $videoLink = $request->request->get('videoLink');

                        if($videoLink == null) {
                            return $this->redirectToRoute('administration');
                        }

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

                    case '2':
                        $enonce = $request->request->get('enonce');
                        $reponses = $request->request->get('otherRep');
                        $tabReponse = explode("_", $reponses);

                        if($enonce == null || $tabReponse == null) {
                            return $this->redirectToRoute('administration');
                        }

                        if($langue == "en"){

                            $wordEn = $em->getRepository('LaccesBundle:wordEn')->find(intval($word));
                            $objEx = new qcmEn($enonce, $wordEn);
                            $em->persist($objEx);
                            $em->flush();
                            $objSolu = new qcmEnonceEn($solution, $objEx);
                            $em->persist($objSolu);
                            $em->flush();

                            foreach ($tabReponse as $r){
                                $objRep = new qcmEnonceEn($r, $objEx);
                                $em->persist($objRep);
                                $em->flush();
                            }

                            $objSolu = $em->getRepository('LaccesBundle:Exercise\qcmEnonceEn')->findQcmenonceByQcmAndEnonce($solution);
                            $objEx->setSolution($objSolu->getId());
                            $em->persist($objEx);
                            $em->flush();
                        }else{

                            $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);
                            $objEx = new qcmFr($enonce, $wordFr);
                            $em->persist($objEx);
                            $em->flush();
                            $objSolu = new qcmEnonceFr($solution, $objEx);
                            $em->persist($objSolu);
                            $em->flush();

                            foreach ($tabReponse as $r){
                                $objRep = new qcmEnonceFr($r, $objEx);
                                $em->persist($objRep);
                                $em->flush();
                            }

                            $objSolu = $em->getRepository('LaccesBundle:Exercise\qcmEnonceFr')->findQcmenonceByQcmAndEnonce($solution);
                            $objEx->setSolution($objSolu->getId());
                            $em->persist($objEx);
                            $em->flush();
                        }
                        break;

                    case '3':
                        $videoLink = $request->request->get('videoLink');
                        $reponses = $request->request->get('otherRep');
                        $tabReponse = explode("_", $reponses);

                        if($videoLink == null || $tabReponse == null) {
                            return $this->redirectToRoute('administration');
                        }

                        if($langue == "en"){

                            $wordEn = $em->getRepository('LaccesBundle:wordEn')->find($word);
                            $objEx = new qcmVideoEn($videoLink, $wordEn);
                            $em->persist($objEx);
                            $em->flush();
                            $objSolu = new qcmEnonceVideoEn($solution, $objEx);
                            $em->persist($objSolu);
                            $em->flush();

                            foreach ($tabReponse as $r){
                                $objRep = new qcmEnonceVideoEn($r, $objEx);
                                $em->persist($objRep);
                                $em->flush();
                            }

                            $objSolu = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoEn')->findQcmenonceByQcmAndEnonce($solution);
                            $objEx->setSolution($objSolu->getId());
                            $em->persist($objEx);
                            $em->flush();
                        }else{

                            $wordFr = $em->getRepository('LaccesBundle:wordFr')->find($word);
                            $objEx = new qcmVideoFr($videoLink, $wordFr);
                            $em->persist($objEx);
                            $em->flush();
                            $objSolu = new qcmEnonceVideoFr($solution, $objEx);
                            $em->persist($objSolu);
                            $em->flush();

                            foreach ($tabReponse as $r){
                                $objRep = new qcmEnonceVideoFr($r, $objEx);
                                $em->persist($objRep);
                                $em->flush();
                            }

                            $objSolu = $em->getRepository('LaccesBundle:Exercise\qcmEnonceVideoFr')->findQcmenonceByQcmAndEnonce($solution);
                            $objEx->setSolution($objSolu->getId());
                            $em->persist($objEx);
                            $em->flush();
                        }
                        break;

                    case '4':
                        $enonce = $request->request->get('enonce');

                        if($enonce == null) {
                            return $this->redirectToRoute('administration');
                        }

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
            }

            return new JsonResponse('ok');
        }
        return $this->redirectToRoute('administration');
    }

    public function listExerciceFrAction(){
        $em = $this->getDoctrine()->getManager();
        $comparaisonVideo = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->findAll();
        $qcm = $em->getRepository('LaccesBundle:Exercise\qcmFr')->findAll();
        $qcmVideo = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->findAll();
        $reformulation = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->findAll();
        $significationVideo = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->findAll();

        return $this->render('@Lacces/Exercices/EditExercice/listExerciceFr.html.twig', array(
            'comparaisonVideo' => $comparaisonVideo,
            'qcm' => $qcm,
            'qcmVideo' => $qcmVideo,
            'reformulation' => $reformulation,
            'significationVideo' =>$significationVideo
        ));
    }

    public function listExerciceEnAction(){
        $em = $this->getDoctrine()->getManager();
        $comparaisonVideo = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->findAll();
        $qcm = $em->getRepository('LaccesBundle:Exercise\qcmEn')->findAll();
        $qcmVideo = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->findAll();
        $reformulation = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->findAll();
        $significationVideo = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->findAll();

        return $this->render('@Lacces/Exercices/EditExercice/listExerciceEn.html.twig', array(
            'comparaisonVideo' => $comparaisonVideo,
            'qcm' => $qcm,
            'qcmVideo' => $qcmVideo,
            'reformulation' => $reformulation,
            'significationVideo' =>$significationVideo
        ));
    }

    public function removeExerciceAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $id = $request->request->get('id');
        $type = $request->request->get('type');
        $langue = $request->request->get('langue');

        if($langue == "fr"){
            switch ($type){
                case "A1":
                    $ex = $em->getRepository('LaccesBundle:Exercise\significationVideoFr')->find($id);
                    break;
                case "A2":
                    $ex = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoFr')->find($id);
                    break;
                case "B":
                    $ex = $em->getRepository('LaccesBundle:Exercise\qcmFr')->find($id);
                    break;
                case "C":
                    $ex = $em->getRepository('LaccesBundle:Exercise\qcmVideoFr')->find($id);
                    break;
                case "D":
                    $ex = $em->getRepository('LaccesBundle:Exercise\reformulationFr')->find($id);
                    break;
            }

            if($ex){
                $em->remove($ex);
                $em->flush();
            }else{
                return $this->redirectToRoute("administration");
            }
        }else if($langue == "en"){
            switch ($type){
                case "A1":
                    $ex = $em->getRepository('LaccesBundle:Exercise\significationVideoEn')->find($id);
                    break;
                case "A2":
                    $ex = $em->getRepository('LaccesBundle:Exercise\comparaisonVideoEn')->find($id);
                    break;
                case "B":
                    $ex = $em->getRepository('LaccesBundle:Exercise\qcmEn')->find($id);
                    break;
                case "C":
                    $ex = $em->getRepository('LaccesBundle:Exercise\qcmVideoEn')->find($id);
                    break;
                case "D":
                    $ex = $em->getRepository('LaccesBundle:Exercise\reformulationEn')->find($id);
                    break;
            }

            if($ex){
                $em->remove($ex);
                $em->flush();
            }else{
                return $this->redirectToRoute("administration");
            }
        }else{
            return $this->redirectToRoute("administration");
        }

        return new JsonResponse('ok');
    }
}