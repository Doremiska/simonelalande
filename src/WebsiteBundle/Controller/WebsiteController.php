<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WebsiteBundle\Form\ContactType;

class WebsiteController extends Controller
{
    public function indexAction()
    {
        // On passe la date d'ajourd'hui en paramètre pour l'affichage de l'année en cours
        $date = new \Datetime();
        $date->modify('-1day');
        
        // On crée une dexuième date avec de décalage de 6 mois pour récupérer seulement les annonces des 6 derniers mois pour la page d'accueil
        $dateLimit = new \Datetime();
        $dateLimit->modify('-6 months');
        
        // On récupère toutes les annonces datant de moins de 6 mois en trois listes (incluant celles à venir)
        // past, future, toComUp
        $listAdvertsPast = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsPast($dateLimit, $date)
        ;
        $listAdvertsFuture = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsFuture($date)
        ;
        $listAdvertsToComeUp = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsToComeUp()
        ;
        
        return $this->render('WebsiteBundle:Website:index.html.twig', array(
            'listAdvertsPast' => $listAdvertsPast,
            'listAdvertsFuture' => $listAdvertsFuture,
            'listAdvertsToComeUp' => $listAdvertsToComeUp,
            'date' => $date
        ));
    }
    
    public function events_oldAction(Request $request)
    {
        // On crée la date limite des évènements anciens (plus de 6 mois)
        $dateLimit = new \Datetime();
        $dateLimit->modify('-6 months');
        
        // On récupère la query de toutes les annonces datants de plus de 6 mois
        $query = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsOld($dateLimit)
        ;
        
        // On pagine la liste des annonces
        $paginator = $this->get('knp_paginator');
        $listAdverts = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        
        // On récupère le nombre de pages
        $nbPages = $listAdverts->getPageCount();
        
        // On vérifie que la page entrée est valide
        if ($request->query->getInt('page', 1) < 1 || $request->query->getInt('page', 1) > $nbPages) {
            throw new NotFoundHttpException("La page ".$request->query->get('page'). " n'existe pas. Veuillez effacer la partie : \"?page=".$request->query->get('page')."\" de votre barre de recherche pour revenir sur la première page ou rentrer un numéro de page valide.");
        }
        
        return $this->render('WebsiteBundle:Website:events_old.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
    
    public function access_barsAction()
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
    
    public function relation_aideAction()
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
    
    public function mon_approcheAction()
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
                ->setTo('doremiska@gmail.com')
                ->setBody(
                    $this->renderView(
                        'Emails/contact_email.html.twig',
                        array(
                            'contenu' => nl2br($data['contenu']),
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
