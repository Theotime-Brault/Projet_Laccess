<?php

namespace searchWord\searchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@search/Default/index.html.twig');
    }
}
