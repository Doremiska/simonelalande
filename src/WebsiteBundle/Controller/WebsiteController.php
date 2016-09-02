<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        
        // On récupère toutes les annonces datant de moins de 6 mois (incluant celles à venir)
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsBefore($dateLimit)
        ;
        
        return $this->render('WebsiteBundle:Website:index.html.twig', array(
            'listAdverts' => $listAdverts,
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
            ->getAdvertsAfter($dateLimit)
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
        return $this->render('WebsiteBundle:Website:access_bars.html.twig');
    }
    
    public function relation_aideAction()
    {
        return $this->render('WebsiteBundle:Website:relation_aide.html.twig');
    }
    
    public function sophrologieAction()
    {
        return $this->render('WebsiteBundle:Website:sophrologie.html.twig');
    }
    
    public function mon_approcheAction()
    {
        return $this->render('WebsiteBundle:Website:mon_approche.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('WebsiteBundle:Website:contact.html.twig');
    }
    
}
