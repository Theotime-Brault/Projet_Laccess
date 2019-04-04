<?php
/**
 * Created by PhpStorm.
 * User: Brandon-PC
 * Date: 31/01/2019
 * Time: 13:44
 */

namespace Lacces\LaccesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function adminLoginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('@Lacces/Security/adminLogin.html.twig', array(
            'last_username' => $lastUserName,
            'error' => $error
        ));
    }

    public function loginCheckAction()
    {
        throw new \Exception("Unexpected loginCheck action");
    }

    public function logoutAction()
    {
        throw new \Exception("Unexpected logout action");
    }
}