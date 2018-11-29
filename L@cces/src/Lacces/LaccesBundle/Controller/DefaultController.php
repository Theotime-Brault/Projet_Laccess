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

    public function wordAction($word, $langue)
    {
        $em = $this->getDoctrine()->getManager();

        if($langue == "fr"){
          $objWord = $em->getRepository('LaccesBundle:wordFr')->findOneBy(array('word' => $word));
          $objWordTrad = $em->getRepository('LaccesBundle:wordEn')
          ->findOneBy(array(
              'id' => $em
                      ->getRepository('LaccesBundle:traductionFrEn')
                      ->findIdEnByIdFr($objWord->getId())
          ));
        }else if($langue == "en"){
          $objWord = $em->getRepository('LaccesBundle:wordEn')->findOneBy(array('word' => $word));
          $objWordTrad = $em->getRepository('LaccesBundle:wordFr')
          ->findOneBy(array(
            'id' => $em
                    ->getRepository('LaccesBundle:traductionFrEn')
                    ->findIdFrByIdEn($objWord->getId())
            ));
        }else{
          $this->redirectToRoute('');
        }

        if (null === $objWordTrad)
        {
            throw new NotFoundHttpException("Le mot " . $word . " n'existe pas.");
        }

        return $this->render('@Lacces/Words/word.html.twig', array(
            'word' => $objWord,
            'wordTrad' => $objWordTrad
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
}
