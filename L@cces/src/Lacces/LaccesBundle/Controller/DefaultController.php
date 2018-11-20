<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Lacces/Default/index.html.twig');
    }

    public function wordAction($word)
    {
        return $this->render('@Lacces/Words/word.html.twig', array('word' => $word));
    }
}
