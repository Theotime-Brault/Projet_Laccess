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
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();
        $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findAll();

        return $this->render('@Lacces/Default/index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
          'wordEn' => $wordsEnObj,
          'wordFr' => $wordsFrObj,
        ]);
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

    public function signeurFrAction()
    {
        return $this->render('@Lacces/Signeurs/signeurFr.html.twig');
    }

    public function signeurEnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();

        return $this->render('@Lacces/Signeurs/signeurEn.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordEn' => $wordsEnObj,
        ]);
    }
}
