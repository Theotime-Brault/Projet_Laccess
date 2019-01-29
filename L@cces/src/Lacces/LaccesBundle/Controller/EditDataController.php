<?php

namespace Lacces\LaccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class EditDataController extends Controller
{
    public function editAction() {
        return $this->render('@Lacces/EditData/editData.html.twig');
    }

    public function addAction() {
        return $this->render('@Lacces/EditData/addData.html.twig');
    }

    public function removeAction() {
        return $this->render('@Lacces/EditData/removeData.html.twig');
    }
}
