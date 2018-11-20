<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Lacces/Default/index.html.twig');
    }
}
