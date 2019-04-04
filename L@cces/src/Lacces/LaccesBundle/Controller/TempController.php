<?php
namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TempController extends Controller
{
    public function tempAction()
    {
        return $this->render('@Lacces/temp.html.twig');
    }
}