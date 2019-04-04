<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\Forms\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

//--------------A supprimé pour activation du site-------------
/**
 * @IsGranted("ROLE_ADMIN")
 */
//-------------------------------------------------------------

class ContactController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();

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
                    'class' => "btn btn-hover background-color-orange-lacces waves-effect",
                )))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formulaire = $form->getData();
            $this->addFlash('info', "Le message a bien été envoyé !");

            //L'adresse qui recevra les mails, doit être la même que celle inscrit dans "parameters.yaml" dans "app/config":
            $mail = 'testlacces@gmail.com';

            //Adresse de l'utilisateur
            $userMail = $formulaire->getEmail();

            $message = \Swift_Message::newInstance('Formulaire de Contact')
                ->setFrom($mail,$formulaire->getNom().' '.$formulaire->getPrenom())  //Adresse de l'expéditeur
                ->setReplyTo($userMail)                                                    //Permet de répondre au mail envoyé par l'utilisateur
                ->setTo($mail)                                                             //Envoie le mail à cette adresse
                ->setCharset('UTF-8')
                ->setContentType('text/html')
                ->setBody('Nom : '.$formulaire->getNom()
                    .'<br />Prénom : '.$formulaire->getPrenom()
                    .'<br />Email : '.$userMail
                    .'<br />Message : '.$formulaire->getMessage()
                    );
            $mailer->send($message);

            return $this->redirectToRoute('lacces_homepage');

        }

        return $this->render('@Lacces/Contact/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}