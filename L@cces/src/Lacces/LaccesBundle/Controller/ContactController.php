<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;



class ContactController extends Controller
{

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
                    'class' => "btn btn-contact background-color-orange-lacces waves-effect",
                )))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formulaire = $form->getData();
            $this->addFlash('info', "Le message a bien été envoyé !");

            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('testlacces@gmail.com')->setPassword('TestL@cces1--');


            $mailer = \Swift_Mailer::newInstance($transport);
            $message = \Swift_Message::newInstance('Formulaire de Contact')
                ->setFrom($formulaire->getEmail())
                ->setTo('testlacces@gmail.com')
                ->setCharset('UTF-8')
                ->setContentType('text/html')
                ->setBody('Nom : '.$formulaire->getNom()
                    .'<br />Prénom : '.$formulaire->getPrenom()
                    .'<br />Email : '.$formulaire->getEmail()
                    .'<br />Message : '.$formulaire->getMessage()
                    );
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('lacces_homepage');

        }

        return $this->render('@Lacces/Contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}