<?php
namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TempController extends Controller
{
    public function tempAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logo = $em->getRepository('LaccesBundle:Logo')->find(1);
        return $this->render('@Lacces/temp.html.twig', [
            'logo' => $logo
        ]);
    }
}