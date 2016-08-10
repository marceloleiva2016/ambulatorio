<?php

namespace MSP\UserAmbulatoriosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MSP\UserAmbulatoriosBundle\Entity\User;
use MSP\UserAmbulatoriosBundle\Form\UserType;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository('MSPUserAmbulatoriosBundle:User')->findAll();
        
        /*
        $res = 'Lista de usuarios: <br />';
        
        foreach($users as $user) 
        {
            $res .= 'Usuario: ' . $user->getUsername() . ' - Email:' . $user->getEmail() . '<br />';
        }
        
        return new Response($res);
        */
        
        return $this->render('MSPUserAmbulatoriosBundle:User:index.html.twig', array('users' => $users));
    }
    
    public function addAction()
    
    {
       $user = new User();
       $form = $this->createCreateForm($user); 
       
       return $this->render('MSPUserAmbulatoriosBundle:User:add.html.twig', array('form' => $form->createView()));
    }
    
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
                'action' => $this->generateUrl('msp_user_ambulatorios_create'),
                'method' => 'POST'
            ));
        
        return $form;
    }
    
        public function createAction(Request $request)
    {   
        $user = new User();
        $form = $this->createCreateForm($user);
        $form->handleRequest($request);
            
            if($form->isValid())
            {
                    
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
        
               return $this->redirectToRoute('msp_user_ambulatorios_index');
               
            }
            
            return $this->render('MSPUserAmbulatoriosBundle:User:add.html.twig', array('form' => $form->createView()));
    }
    
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('msp_user_ambulatorios_create'),
            'method' => 'POST'
        ));
        
        return $form;
    }
    
    public  function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('MSPUserAmbulatoriosBundle:User');
        
        $user = $repository->find($id);
        
        return new Response('Usuario: ' . $user->getUsername() . ' con email: ' . $user->getEmail());
    }
}   