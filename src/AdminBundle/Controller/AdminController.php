<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Form\AdvertType;
use WebsiteBundle\Entity\Advert;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Admin:index.html.twig');
    }
    
    public function addAction(Request $request)
    {
        $advert = new Advert;
        $form = $this->createForm(AdvertType::class, $advert);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', "Annonce bien enregistrée.");
            
            return $this->redirectToRoute('website_homepage');
        }
        
        return $this->render('AdminBundle:Admin:add.html.twig', array('form' => $form->createView()));
    }
    
    public function editAction()
    {
        return $this->render('AdminBundle:Admin:edit.html.twig');
    }
    
    public function deleteAction()
    {
        return $this->render('AdminBundle:Admin:delete.html.twig');
    }
}
