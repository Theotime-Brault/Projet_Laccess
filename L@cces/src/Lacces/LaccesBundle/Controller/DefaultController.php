<?php

namespace Lacces\LaccesBundle\Controller;


use Lacces\LaccesBundle\Entity\wordFr;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Repository\wordFrRepository;
use Lacces\LaccesBundle\Repository\wordEnRepository;
use Lacces\LaccesBundle\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Email;


class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Lacces/Default/index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @param $word
     * @param $langue
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function wordAction($word, $langue)
    {
        $em = $this->getDoctrine()->getManager();

        if($langue == "fr"){
          $objWord = $em->getRepository('LaccesBundle:wordFr')->findByWord($word);
        }else if($langue == "en"){
          $objWord = $em->getRepository('LaccesBundle:wordEn')->findByWord($word);
        }else{
          $this->redirectToRoute('');
        }

        if(!$objWord){
          throw $this->createNotFoundException('Cette page n éxiste pas');
        }

        return $this->render('@Lacces/Words/word.html.twig', array(
            'word' => $objWord,
            'langue' => $langue,
          ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBarreAction()
    {
        return $this->render('@Lacces/SearchBarre/searchBarre.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireFrAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findAll();

        return $this->render('@Lacces/Signaires/signaireFr.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordFr' => $wordsFrObj,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireEnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();

        return $this->render('@Lacces/Signaires/signaireEn.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordEn' => $wordsEnObj,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {

        $formulaire = new Form();

        $form = $this->createFormBuilder($formulaire)
            ->add('nom', TextType::class, array('attr' => array(
                'maxlength' => "30",
                'class' => "formValue",
                'data-length' => "30",
            )))
            ->add('prenom', TextType::class, array('attr' => array(
                'maxlength' => "30",
                'class' => "formValue",
                'data-length' => "30",
            )))
            ->add('Email', EmailType::class, array('attr' => array(
                'class' => "validate",
                'type' => "email"
            )))

            ->add('message', TextareaType::class, array('attr' => array(
                'maxlength' => "500",
                'class' => "materialize-textarea formValue",
                'data-length' => "500"
            )))
            ->add('submit', SubmitType::class, array(
                'label' => 'Envoyer',
                'attr' => array(
                    'class' => "btn background-color-orange-lacces waves-effect"
            )))

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formulaire = $form->getData();


            return $this->redirectToRoute('lacces_homepage');

        }

        return $this->render('@Lacces/Contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mentionsAction()
    {
        return $this->render('@Lacces/Mentions_legales/mentions.html.twig');
    }

    public function faqAction()
    {
        return $this->render('@Lacces/FAQ/faq.html.twig');
    }

    /**
     * @param $langue
     * @param $word
     * @return JsonResponse
     */
    public function autoCompleteAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $langue = $request->request->get('langue');
        $word = $request->request->get('word');
        if($langue == "fr"){
            $words = $em->getRepository('LaccesBundle:wordFr')->findByPopularity();
        }elseif($langue == "en"){
            $words = $em->getRepository('LaccesBundle:wordEn')->findByPopularity();
        }else{
            $words =null;
        }

        return new JsonResponse(array('words'=>$words));
    }
}
