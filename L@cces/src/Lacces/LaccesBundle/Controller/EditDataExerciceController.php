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
use Lacces\LaccesBundle\Entity\Forms\FormExRefomSign;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class EditDataExerciceController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function exerciceAddEnAction(Request $request){
        //formulaire permettant de choisir le mot et le type d'exercice
        //https://symfony.com/doc/current/form/dynamic_form_modification.html#form-events-submitted-data

        //tester l'exemple de la doc avec le choix de langue qui va chercher la list de mots
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
            ->add('typeEx', ChoiceType::class, [
                'choices' => [
                    'Signification video' => '0',
                    'QCM' => '1',
                    'QCM video' => '2',
                    'Reformulation' => '3'
                ],
                'placeholder' => 'Selectionner le type d\'exercice'
            ]);
            //->add('Valider', SubmitType::class)

        $formModifier = function (FormInterface $form, $typeEx = null) {
            if($typeEx === null){
                $ex = null;
            }else{
                switch ($typeEx){
                    case 0:
                        $ex = new significationVideoEn();
                        //$form->add('ex', )
                        break;
                    case 1:
                        $ex = new qcmEn();
                        $form->add('question', TextType::class, [
                            'label' => 'Question'
                        ])
                        ->add('solution', IntegerType::class, [
                            'required' => false,
                        ]);
                        break;
                    case 2:
                        $ex = new qcmVideoEn();
                        break;
                    case 3:
                        $ex = new reformulationEn();
                        break;
                }
            }
        };

        $form->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event['typeEx']->getData();

                $formModifier($event->getForm(), $data);
            }
        );

        $form->get('typeEx')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $ex = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $ex);
            }
        );

        $form->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
        return $this->render('@Lacces/Exercices/EditExercice/addExerciceEn.html.twig', array(
            'form' =>$form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
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
    /*public function addExerciceSignificationVideoEnAction(Request $request, $langue, $word){
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
    }*/
}