<?php

namespace Lacces\LaccesBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\Forms\FormAddData;
use Lacces\LaccesBundle\Entity\Forms\FormEditData;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Entity\wordFr;
//use Lacces\LaccesBundle\Entity\traductionFrEn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;


class EditDataController extends Controller
{
    public function adminAction()
    {
        return $this->render("@Lacces/Administration/administration.html.twig");
    }

    public function editAction(Request $request, $wordId, $langue) {

      $em = $this->getDoctrine()->getManager();

      if($langue == 'fr') {
        $word = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
      } else {
        $word = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
      }

      $formulaire = new FormEditData();

      $form = $this->createFormBuilder($formulaire)

        ->add('word', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'value' => $word->getWord(),
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLink', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'value' => $word->getVideoLink(),
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentence', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'value' => $word->getContextSentence(),
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescription', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'value' => $word->getVideoDescription(),
          'class' => "formValue",
          'data-length' => "200",
        )))

        //VALIDATION

        ->add('submit', SubmitType::class, array(
          'label' => 'Modifier',
          'attr' => array(
            'class' => "btn btn-hover background-color-orange-lacces waves-effect",
          )))
        ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $formulaire = $form->getData();
        $this->addFlash('info', "Le mot à bien été modifié !");

        $word->setWord($formulaire->getWord());
        $word->setVideoLink($formulaire->getVideoLink());
        $word->setContextSentence($formulaire->getContextSentence());
        $word->setVideoDescription($formulaire->getVideoDescription());

        $em->persist($word);
        $em->flush();

        return $this->redirectToRoute('lacces_wordList', array('langue' => $langue));

      }
      return $this->render('@Lacces/Administration/EditData/editData.html.twig', array(
        'langue' => $langue,
        'form' => $form->createView(),
        'word' => $word->getWord()
      ));
    }

  /**
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
    public function addAction(Request $request) {

      $formulaire = new FormAddData();

      $form = $this->createFormBuilder($formulaire)

        //MOT FRANCAIS

        ->add('wordFr', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescriptionFr', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))

        //MOT ANGLAIS

        ->add('wordEn', TextType::class, array('attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('videoDescriptionEn', TextType::class, array('attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))

        //VALIDATION

        ->add('submit', SubmitType::class, array(
          'label' => 'Envoyer',
          'attr' => array(
            'class' => "btn btn-hover background-color-orange-lacces waves-effect",
          )))
        ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

          $em = $this->getDoctrine()->getManager();
        $formulaire = $form->getData();
        $this->addFlash('info', "Le mot à bien été crée !");

        $monMotFr = new wordFr();
        $monMotEn = new wordEn();

        $monMotFr->setWord($formulaire->getWordFr());
        $monMotFr->setVideoLink($formulaire->getVideoLinkFr());
        $monMotFr->setContextSentence($formulaire->getContextSentenceFr());
        $monMotFr->setVideoDescription($formulaire->getVideoDescriptionFr());
        $monMotFr->setPopularity(0);

        $monMotEn->setWord($formulaire->getWordEn());
        $monMotEn->setVideoLink($formulaire->getVideoLinkEn());
        $monMotEn->setContextSentence($formulaire->getContextSentenceEn());
        $monMotEn->setVideoDescription($formulaire->getVideoDescriptionEn());
        $monMotEn->setPopularity(0);
        $monMotEn->setWordFrs(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordEn'), new ArrayCollection([$monMotFr])));
        $monMotFr->setWordEns(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordFr'), new ArrayCollection([$monMotEn])));

        $em->persist($monMotFr);
        $em->persist($monMotEn);
          $em->flush();


        return $this->render('@Lacces/Administration/EditData/addData.html.twig', array(
          'form' => $form->createView(),
        ));
      }
      return $this->render('@Lacces/Administration/EditData/addData.html.twig', array(
        'form' => $form->createView(),
      ));
    }
    public function removeAction(Request $request) {

        $id = $request->get('id');
        $langue = $request->get('langue');
        $em = $this->getDoctrine()->getManager();


        if($langue == "fr") {
          $word = $em->getRepository('LaccesBundle:wordFr')->find($id);
        } else if($langue == "en") {
          $word = $em->getRepository('LaccesBundle:wordEn')->find($id);
        }

        $em->remove($word);
        $em->flush();

      return new JsonResponse(array('id' => $id));

    }

    public function wordListAction(Request $request, $langue) {

      $em = $this->getDoctrine()->getManager();
      $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findAll();
      $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();


      return $this->render('@Lacces/Administration/EditData/wordList.html.twig', [
        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        'wordFr' => $wordsFrObj,
        'wordEn' => $wordsEnObj,
        'langue' => $langue
      ]);
    }
}
