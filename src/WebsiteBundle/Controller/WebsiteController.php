<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WebsiteBundle\Form\Type\ContactType;

class WebsiteController extends Controller
{
    public function indexAction()
    {
        // On passe la date d'ajourd'hui en paramètre pour l'affichage de l'année en cours
        $date = new \Datetime();
        $date->modify('-1day');
        
        // On récupère les annonces à venir (date définie)
        $listAdvertsFuture = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsFuture($date)
        ;
        
        // On récupère les annonces à venir (date non définie)
        $listAdvertsToComeUp = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsToComeUp()
        ;
        
        return $this->render('WebsiteBundle:Website:index.html.twig', array(
            'listAdvertsFuture' => $listAdvertsFuture,
            'listAdvertsToComeUp' => $listAdvertsToComeUp,
            'date' => $date
        ));
    }
    
    public function accessBarsAction()
    {
        $date = new \Datetime();
        $date->modify('-1day');
        
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategory($date, 'Access Bars')
        ;
        $listAdvertsToComeUp = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategoryToComeUp('Access Bars')
        ;
        
        return $this->render('WebsiteBundle:Website:access_bars.html.twig', array(
            'listAdverts' => $listAdverts,
            'listAdvertsToComeUp' => $listAdvertsToComeUp
        ));
    }
    
    public function relationAideAction()
    {
        $date = new \Datetime();
        $date->modify('-1day');
        
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategory($date, 'Relation d\'Aide')
        ;
        $listAdvertsToComeUp = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategoryToComeUp('Relation d\'Aide')
        ;
        
        return $this->render('WebsiteBundle:Website:relation_aide.html.twig', array(
            'listAdverts' => $listAdverts,
            'listAdvertsToComeUp' => $listAdvertsToComeUp
        ));
    }
    
    public function sophrologieAction()
    {
        $date = new \Datetime();
        $date->modify('-1day');
        
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategory($date, 'Sophrologie')
        ;
        $listAdvertsToComeUp = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsCategoryToComeUp('Sophrologie')
        ;
        
        return $this->render('WebsiteBundle:Website:sophrologie.html.twig', array(
            'listAdverts' => $listAdverts,
            'listAdvertsToComeUp' => $listAdvertsToComeUp
        ));
    }
    
    public function monApprocheAction()
    {
        return $this->render('WebsiteBundle:Website:mon_approche.html.twig');
    }
    
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            
            // Envoye de l'email
            $data = $form->getData();
            $message = \Swift_Message::newInstance()
                ->setSubject($data['objet'])
                ->setFrom($data['email'])
                ->setTo('simone.lalande1@gmail.com')
                ->setBody(
                    $this->renderView(
                        'Emails/contact_email.html.twig',
                        array(
                            'contenu' => $data['contenu'],
                            'nom' => $data['nom'],
                            'prenom' => $data['prenom']
                        )
                    ),
                    'text/html'
                )
            ;
            
            $this->get('mailer')->send($message);
            
            $request->getSession()->getFlashBag()->add('notice', "Votre message a bien été envoyé.");
            
            return $this->redirect($this->generateUrl('website_contact').'#formulaire_contact');
            
        } 
        
        return $this->render('WebsiteBundle:Website:contact.html.twig', array('form' => $form->createView()));
    }
    
}
