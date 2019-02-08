<?php
/**
 * Created by PhpStorm.
 * User: flo
 * Date: 07/02/19
 * Time: 15:12
 */

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Forms\FormExRefomSign;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class EditDataExerciceController extends Controller
{
    public function exerciceAddEnAction(Request $request){
        //formulaire permettant de choisir le mot la langue et le type de mot
        $em = $this->getDoctrine()->getManager();
        $words = $em->getRepository('LaccesBundle:wordEn')->findAll();
        $add = array('add'=>'type');
        $form = $this->createFormBuilder($add)
            ->add('wordEn', ChoiceType::class, [
                'choices' => $words,
                'choice_label' => function($word, $key, $index){
                    return $word->getWord();
                },
                'placeholder' => 'Selectionner un mot'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Signification video' => '0',
                    'QCM' => '1',
                    'QCM video' => '2',
                    'Reformulation' => '3'
                ],
                'placeholder' => 'Selectionner le type d\'exercice'
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
        return $this->render('@Lacces/Exercices/EditExercice/addExerciceEn.html.twig', array(
            'form' =>$form->createView()
        ));
    }

    public function exerciceAddFrAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $words = $em->getRepository('LaccesBundle:wordFr')->findAll();
        $add = array('add'=>'type');
        $form = $this->createFormBuilder($add)
            ->add('wordEn', ChoiceType::class, [
                'choices' => $words,
                'choice_label' => function($word, $key, $index){
                    return $word->getWord();
                },
                'placeholder' => 'Selectionner un mot'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Signification video' => '0',
                    'QCM' => '1',
                    'QCM video' => '2',
                    'Reformulation' => '3'
                ],
                'placeholder' => 'Selectionner le type d\'exercice'
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('@Lacces/Exercices/EditExercice/addExerciceFr.html.twig', array(
            'form' =>$form->createView()
        ));
    }

    //pour un exo preci, fonction appller en ajax
    public function addExerciceSignificationVideoEnAction(Request $request, $langue, $word){
        $exSignification = new significationVideoEn();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(FormExRefomSign::class, $exSignification);
        $form->add('videoLink', TextType::class,[
            'label' => 'Lien video'
        ])
        ->add('Ajouter', SubmitType::class);

        $form->handleRequest($request);

        if ($request -> isXmlHttpRequest()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($exSignification);
                $em->flush();

                $this->addFlash('info',"Exercice ajouter");

                return $this->redirectToRoute('lacces_ex_add');
            }
        }
        return new JsonResponse();
    }
}