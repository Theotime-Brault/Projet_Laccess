<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\wordFr;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Repository\wordFrRepository;
use Lacces\LaccesBundle\Repository\wordEnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class DefaultController extends Controller
{
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

    public function contactAction()
    {
        return $this->render('@Lacces/Contact/contact.html.twig');
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
