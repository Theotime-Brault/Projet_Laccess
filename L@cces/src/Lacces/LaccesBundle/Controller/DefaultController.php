<?php

namespace Lacces\LaccesBundle\Controller;


use Lacces\LaccesBundle\Entity\wordFr;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Repository\wordFrRepository;
use Lacces\LaccesBundle\Repository\wordEnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;



class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $i = 0;
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findByPopularity();
        $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findByPopularity();

        return $this->render('@Lacces/Default/index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
          'wordEn' => $wordsEnObj,
          'wordFr' => $wordsFrObj,
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

    public function searchBarreAction()
    {
        return $this->render('@Lacces/SearchBarre/searchBarre.html.twig');
    }

    public function signaireFrAction()
    {
        return $this->render('@Lacces/Signaires/signaireFr.html.twig');
    }

    public function signaireEnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();

        return $this->render('@Lacces/Signaires/signaireEn.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordEn' => $wordsEnObj,
        ]);
    }

    public function contactAction(Request $request)
    {
        $firstname = $lastname = $email = $object = $message = NULL;

        $contact_error_firstnamemin = NULL;

        $form = $this->createFormBuilder()

            ->add('firstname', TextType::class, array('constraints' => array(new NotBlank(array(//'message' => 'contact.error.firstname'
        )), new Length(array('min' => 3,
                             'max' => 10,
                )))))

            ->add('lastname', TextType::class, array('constraints' => array(new NotBlank(array(
        )), new Length(array('min' => 3,
                             'max' => 10,
        )))))

            ->add('email', TextType::class, array('constraints' => array(
                new Assert\Email(array('checkMX' => true)),
                new NotBlank(),
        )))

            ->add('object', TextType::class, array('constraints' => array(new Length(array('min' => 3)))))

            ->add('message', TextareaType::class, array('constraints' => array(new NotBlank(array(
        )), new Length(array('min' => 8,
                             'max' => 10,
        )))))

        ->add('send', SubmitType::class, array('label' => 'Envoyer'))
        ->add('reset', ResetType::class, array('label' => 'Reset'))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isValid() ) {

            if ($request->isMethod('POST')) {

                $request = Request::createFromGlobals();

                $firstname = $form["firstname"]->getData();
                $lastname = $form["lastname"]->getData();
                $email = $form["email"]->getData();
                $object = $form["object"]->getData();
                $message = $form["message"]->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject($object)
                    ->setFrom(array($email))
                    ->setTo('theotime98@hotmail.fr')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->render('@Lacces/SwiftMailer/email.html.twig', array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'object' => $object,
                        'message' => $message)));

                $this->get('mailer')->send($message);

                $this->addFlash('success', 'Ok');
                $this->addFlash('sent', 'Ok');

            } else {
                $this->addFlash('error', 'Can\'t be reached like this');
            }
        }
        else if (($form->isValid() === FALSE) && ($request->isMethod('POST'))) {

            $this->addFlash('error', 'Can\'t be reached like this');
            $this->addFlash('not_sent', 'Not Ok');

        }

        return $this->render('@Lacces/Contact/contact.html.twig', array(
            'form'      => $form->createView(),
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'object'    => $object,
            'message'   => $message
        ));
    }

    public function mentionsAction()
    {
        return $this->render('@Lacces/Mentions_legales/mentions.html.twig');
    }

    public function faqAction()
    {
        return $this->render('@Lacces/FAQ/faq.html.twig');
    }

}
