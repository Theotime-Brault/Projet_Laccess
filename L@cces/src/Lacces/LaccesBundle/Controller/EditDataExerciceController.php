<?php
/**
 * Created by PhpStorm.
 * User: flo
 * Date: 07/02/19
 * Time: 15:12
 */

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Exercise\qcmEn;
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
            $ex = $request->request->get('ex');//defini le type d'exercice
            $langue = $request->request->get('langue');

            if($ex == 1){

            }elseif ($ex == 2){

            }elseif ($ex == 3){

            }elseif ($ex == 4){

            }else{
                if($langue == "en"){
                    return $this->redirectToRoute('lacces_ex__en_add');
                }else{
                    return $this->redirectToRoute('lacces_ex__fr_add');
                }
            }
            return new JsonResponse('ok');
        }
        return $this->redirectToRoute('administration');
    }
}