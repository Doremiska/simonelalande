<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WebsiteBundle\Form\AdvertType;
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
            
            return $this->redirect($this->generateUrl('website_homepage').'#actualites');
        }
        
        return $this->render('AdminBundle:Admin:add.html.twig', array('form' => $form->createView()));
    }
    
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('WebsiteBundle:Advert')->find($id);
        
        if ($advert === null) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        $form = $this->createForm(AdvertType::class, $advert);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', "L'annonce a bien été modifiée.");
            
            return $this->redirect($this->generateUrl('website_homepage').'#actualites');
        }
        
        return $this->render('AdminBundle:Admin:edit.html.twig', array('form' => $form->createView()));
    }
    
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('WebsiteBundle:Advert')->find($id);
        
        if ($advert === null) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        // On crée un formulaire vide qui ne contiendra que le champ CSRF (cela permet de protéger la suppression d'annonce contre cette faille)
        $form = $this->get('form.factory')->create();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', "L'annonce a bien été supprimée.");
            
            return $this->redirect($this->generateUrl('website_homepage').'#actualites');
        }
        
        return $this->render('AdminBundle:Admin:delete.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView()
        ));
    }
}
