<?php

namespace Lacces\LaccesBundle\Controller;

use Lacces\LaccesBundle\Entity\wordFr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Lacces/Default/index.html.twig');
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

        $response = $repository->findOneBy(array('word' => $word));
        if (null === $response)
        {
            throw new NotFoundHttpException("Le mot " . $word . " n'existe pas.");
        }

        return $this->render('@Lacces/Words/word.html.twig', array('word' => $response));
    }
}
