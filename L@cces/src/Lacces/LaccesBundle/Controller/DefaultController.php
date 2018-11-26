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
        /*$em = $this->getDoctrine()->getManager();
        $wordsEn = [$em->getRepository('LaccesBundle:wordEn')->getWord()];
        $wordsFr = [$em->getRepository('LaccesBundle:wordFr')->getWord()];*/

        return $this->render('@Lacces/Default/index.html.twig'/*, [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
          'wordEn' => $wordsEn,
          'wordFr' => $wordsFr,
        ]*/);
    }
/*
    public function wordAction($word)
    {
        return $this->render('@Lacces/Words/word.html.twig', array('word' => $word));
    }*/

    public function wordAction($word)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('LaccesBundle:wordFr');

        $response = $repository->findOneBy(array(
            'word' => $word));

        if (null === $response)
        {
            throw new NotFoundHttpException("Le mot " . $word . " n'existe pas.");
        }

        return $this->render('@Lacces/Words/word.html.twig', array(
            'word' => $response));
    }

    public function searchBarreAction()
    {
        return $this->render('@Lacces/SearchBarre/searchBarre.html.twig');
    }
}
