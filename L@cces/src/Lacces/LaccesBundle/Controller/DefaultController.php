<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();
      $logo = $em->getRepository('LaccesBundle:Logo')->find(1);

      return $this->render('@Lacces/Default/index.html.twig', [
          'logo' => $logo
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
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);

        if($langue == "fr"){
          $objWord = $em->getRepository('LaccesBundle:wordFr')->findByWord($word);
        }else if($langue == "en"){
          $objWord = $em->getRepository('LaccesBundle:wordEn')->findByWord($word);
        }else{
          return $this->redirectToRoute('lacces_homepage');
        }

        if(!$objWord){
            $this->addFlash('info', "Le mot rechercher n'existe pas.");
            return $this->redirectToRoute('lacces_homepage');
        }

        $objWord->setPopularity($objWord->getPopularity() + 1);
        $em->persist($objWord);
        $em->flush();

        return $this->render('@Lacces/Words/word.html.twig', array(
            'word' => $objWord,
            'logo' => $logo,
            'langue' => $langue,
          ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBarreAction(Request $request)
    {
        return $this->render('@Lacces/SearchBarre/searchBarre.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireFrAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);
        $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findAll();

        return $this->render('@Lacces/Signaires/signaireFr.html.twig', [
            'wordFr' => $wordsFrObj,
            'logo' => $logo
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireEnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);

        return $this->render('@Lacces/Signaires/signaireEn.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordEn' => $wordsEnObj,
            'logo' => $logo
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mentionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);
        return $this->render('@Lacces/Mentions_legales/mentions.html.twig', array(
          'logo' => $logo
        ));
    }

    public function faqAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);
        return $this->render('@Lacces/FAQ/faq.html.twig', array(
          'logo' => $logo
        ));
    }


    public function autoCompleteAction(Request $request){
        if ($request -> isXmlHttpRequest()) {
            $l = $request->request->get('l');
            $em = $this->getDoctrine()->getManager();

            if($l == "fr"){
                $word = $em->getRepository('LaccesBundle:wordFr')->findByPopularity();
            }else {
                $word = $em->getRepository('LaccesBundle:wordEn')->findByPopularity();
            }

            return new JsonResponse($word);
        }
/*
            $em = $this->getDoctrine()->getManager();
            $l = $request->request->get('l');
            $word = $request->request->get('word');
            if ($l == "fr") {
                $words = $em->getRepository('LaccesBundle:wordFr')->findByPopularity($word . "%");
            } elseif ($l == "en") {
                $words = $em->getRepository('LaccesBundle:wordEn')->findByPopularity($word . "%");
            } else {
                $words = null;
            }


                    if($word && $l == "fr"){
                        $wordsFr = $em->getRepository('LaccesBundle:wordFr')->findByPopularity($word."%");
                        dump($wordsFr);
                        for ($i=0; $i<sizeof($wordsFr); $i++){
                            $wordsEn[$i] = $wordsFr[$i]->getWordEns();
                        }
                    }else if($word && $l == "en"){
                        $wordsEn = $em->getRepository('LaccesBundle:wordEn')->findByPopularity($word."%");
                        for ($i=0; $i<sizeof($wordsEn); $i++){
                            $wordsFr[$i] = $wordsEn[$i]->getWordFrs();
                        }
                    }else{
                        $wordsFr = null;
                        $wordsEn = null;
                    }

            return new JsonResponse(array('words' => $words));
            //return new JsonResponse(array('wordsFr'=>$wordsFr, 'wordsEn'=>$wordsEn));

        }
        return $this->redirectToRoute('lacces_homepage');*/
    }
}
