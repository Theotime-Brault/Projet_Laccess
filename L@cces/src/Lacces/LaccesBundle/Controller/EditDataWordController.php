<?php

namespace Lacces\LaccesBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Lacces\LaccesBundle\Entity\Forms\FormAddData;
use Lacces\LaccesBundle\Entity\Forms\FormEditData;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Entity\wordFr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class EditDataWordController extends Controller
{
    public function editAction(Request $request, $wordId, $langue) {

      $em = $this->getDoctrine()->getManager();

      if($langue == 'fr') {
        $word = $em->getRepository('LaccesBundle:wordFr')->find($wordId);
      } else {
        $word = $em->getRepository('LaccesBundle:wordEn')->find($wordId);
      }

      $formulaire = new FormEditData();

      $form = $this->createFormBuilder($formulaire)

        ->add('word', TextType::class, array(
          'label' => "Le mot",
          'attr' => array(
          'maxlength' => "50",
          'value' => $word->getWord(),
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLink', TextType::class, array(
          'label' => "Url de la vidéo",
          'attr' => array(
          'maxlength' => "200",
          'value' => $word->getVideoLink(),
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentence', TextType::class, array(
          'label' => "Phrase de contextualisation",
          'attr' => array(
          'maxlength' => "200",
          'value' => $word->getContextSentence(),
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
        $this->addFlash('info', "Le mot a bien été modifié !");

        $word->setWord($formulaire->getWord());
        $word->setVideoLink($formulaire->getVideoLink());
        $word->setContextSentence($formulaire->getContextSentence());

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

        ->add('wordFr', TextType::class, array(
          'label' => "Mot en français",
          'attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkFr', TextType::class, array(
          'label' => "Url de la vidéo française",
          'attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceFr', TextType::class, array(
          'label' => "Phrase de contextualisation française",
          'attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))

        //MOT ANGLAIS

        ->add('wordEn', TextType::class, array(
          'label' => "Mot en américain",
          'attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
        )))
        ->add('videoLinkEn', TextType::class, array(
          'label' => "Url de la vidéo américaine",
          'attr' => array(
          'maxlength' => "200",
          'class' => "formValue",
          'data-length' => "200",
        )))
        ->add('contextSentenceEn', TextType::class, array(
          'label' => "Phrase de contextualisation américaine",
          'attr' => array(
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
        $this->addFlash('info', "Le mot a bien été crée !");

        $monMotFr = new wordFr();
        $monMotEn = new wordEn();

        $monMotFr->setWord($formulaire->getWordFr());
        $monMotFr->setVideoLink($formulaire->getVideoLinkFr());
        $monMotFr->setContextSentence($formulaire->getContextSentenceFr());
        $monMotFr->setPopularity(0);

        $monMotEn->setWord($formulaire->getWordEn());
        $monMotEn->setVideoLink($formulaire->getVideoLinkEn());
        $monMotEn->setContextSentence($formulaire->getContextSentenceEn());
        $monMotEn->setPopularity(0);

        $monMotEn->setWordFrs(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordEn'), new ArrayCollection([$monMotFr])));
        $monMotFr->setWordEns(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordFr'), new ArrayCollection([$monMotEn])));

        $em->persist($monMotFr);
        $em->persist($monMotEn);
        $em->flush();
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

          //On recupere les mot anglais correspondant au mot que l'on supprime
          //et s'ils n'ont qu'une seule traduction (celle que nous supprimons)
          //on les supprime
          foreach ($word->getWordEns() as $wordEn) {
            if(sizeof($wordEn->getWordFrs()) == 1) {
              $em->remove($wordEn);
            }
          }

        } else if($langue == "en") {
          $word = $em->getRepository('LaccesBundle:wordEn')->find($id);

          //idem qu'en haut
          foreach ($word->getWordFrs() as $wordFr) {
            if(sizeof($wordFr->getWordEns()) == 1) {
              $em->remove($wordFr);
            }
          }
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
        'wordFr' => $wordsFrObj,
        'wordEn' => $wordsEnObj,
        'langue' => $langue
      ]);
    }

    public function addTranslationAction(Request $request, $langue, $wordId) {

      if($langue == "fr" || $langue == "en") {

        $em = $this->getDoctrine()->getManager();

        $monMotFr = new wordFr();
        $monMotEn = new wordEn();
        $word = ""; //Sera la valeur du mot à traduire

        $formulaire = new FormAddData();

        if($langue == "fr") {

          //On récupère l'objet du mot anglais
          $monMotEn = $em->getRepository('LaccesBundle:wordEn')->find($wordId);

          //en cas d'erreur
          if(!$monMotFr) {
            $this->addFlash('info', "Le mot de langue : ". $langue. ", à l'id : ". $wordId.", n'existe pas !");
            return $this->render('@Lacces/Administration/EditData/wordList.html.twig');////////////////
          }

          //On attribut "word" à la valeur du mot anglais
          $word = $monMotEn->getWord();
          //Pour eviter des erreurs de formulaire nous remplissons les inputs non visible par les valeur du mot à traduire
          $formulaire->setWordEn($monMotEn->getWord());
          $formulaire->setVideoLinkEn($monMotEn->getVideoLink());
          $formulaire->setContextSentenceEn($monMotEn->getContextSentence());

          //On créé le formulaire d'ajout de mot français

          $form = $this->createFormBuilder($formulaire)
            ->add('wordFr', TextType::class, array(
              'label' => "Mot en français",
              'attr' => array(
              'maxlength' => "50",
              'class' => "formValue",
              'data-length' => "50",
            )))
            ->add('videoLinkFr', TextType::class, array(
              'label' => "Url de la video française",
              'attr' => array(
              'maxlength' => "200",
              'class' => "formValue",
              'data-length' => "200",
            )))
            ->add('contextSentenceFr', TextType::class, array(
              'label' => "Phrase de contextualisation française",
              'attr' => array(
              'maxlength' => "200",
              'class' => "formValue",
              'data-length' => "200",
              )))
            ->add('submit', SubmitType::class, array(
              'label' => 'Envoyer',
              'attr' => array(
                'class' => "btn btn-hover background-color-orange-lacces waves-effect",
              )))
            ->getForm();

        } else {

          //On récupère l'objet du mot français
          $monMotFr = $em->getRepository('LaccesBundle:wordFr')->find($wordId);

          //en cas d'erreur
          if(!$monMotFr) {
            $this->addFlash('info', "Le mot de langue : ". $langue. ", à l'id : ". $wordId.", n'existe pas !");
            return $this->render('@Lacces/Administration/EditData/wordList.html.twig');////////////////
          }

          //On attribut "word" à la valeur du mot français
          $word = $monMotFr->getWord();
          //Pour eviter des erreurs de formulaire nous remplissons les inputs non visible par les valeur du mot à traduire
          $formulaire->setWordFr($monMotFr->getWord());
          $formulaire->setVideoLinkFr($monMotFr->getVideoLink());
          $formulaire->setContextSentenceFr($monMotFr->getContextSentence());

          //On créé le formulaire d'ajout de mot anglais

            $form = $this->createFormBuilder($formulaire)
              ->add('wordEn', TextType::class, array(
                'label' => "Mot en américain",
                'attr' => array(
                'maxlength' => "50",
                'class' => "formValue",
                'data-length' => "50",
                )))
              ->add('videoLinkEn', TextType::class, array(
                'label' => "Url de la video américaine",
                'attr' => array(
                'maxlength' => "200",
                'class' => "formValue",
                'data-length' => "200",
                )))
              ->add('contextSentenceEn', TextType::class, array(
                'label' => "Phrase de contextualisation américaine",
                'attr' => array(
                'maxlength' => "200",
                'class' => "formValue",
                'data-length' => "200",
                )))
              ->add('submit', SubmitType::class, array(
                'label' => 'Envoyer',
                'attr' => array(
                  'class' => "btn btn-hover background-color-orange-lacces waves-effect",
                )))
              ->getForm();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $formulaire = $form->getData();
          $this->addFlash('info', "La traduction a bien été ajouté !");

          if ($langue == "fr") {
            $monMotFr->setWord($formulaire->getWordFr());
            $monMotFr->setVideoLink($formulaire->getVideoLinkFr());
            $monMotFr->setContextSentence($formulaire->getContextSentenceFr());
            $monMotFr->setPopularity(0);
            $monMotFr->setWordEns(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordFr'), new ArrayCollection([$monMotEn])));

            //On ajoute le mot français créé dans les possible traductions du mot anglais
            $monMotEn->getWordFrs()->add($monMotFr);
          }
          else {
            $monMotEn->setWord($formulaire->getWordEn());
            $monMotEn->setVideoLink($formulaire->getVideoLinkEn());
            $monMotEn->setContextSentence($formulaire->getContextSentenceEn());
            $monMotEn->setPopularity(0);
            $monMotEn->setWordFrs(new PersistentCollection($em, $em->getClassMetadata('LaccesBundle:wordEn'), new ArrayCollection([$monMotFr])));

            //On ajoute le mot anglais créé dans les possible traductions du mot français
            $monMotFr->getWordEns()->add($monMotEn);
          }


          $em->persist($monMotEn);
          $em->persist($monMotFr);
          $em->flush();
        }
      }
      return $this->render('@Lacces/Administration/EditData/addTranslation.html.twig', array(
        'form' => $form->createView(),
        'langue' => $langue,
        'word' => $word
      ));
    }
}
