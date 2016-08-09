<?php

namespace MSP\UserAmbulatoriosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MSPUserAmbulatoriosBundle:Default:index.html.twig', array('name' => $name));
    }
}
