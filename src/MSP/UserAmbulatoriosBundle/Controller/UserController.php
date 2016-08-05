<?php

namespace MSP\UserAmbulatoriosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository('MSPUserAmbulatoriosBundle:User')->findAll();
        
        $res = 'Lista de usuarios: <br />';
        
        foreach($users as $user) 
        {
            $res .= 'Usuario: ' . $user->getUsername() . ' - Email:' . $user->getEmail() . '<br />';
        }
        
        return new Response($res);
        
    }
}    