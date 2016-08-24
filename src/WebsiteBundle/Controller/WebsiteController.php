<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{
    public function indexAction()
    {
        // On passe la date d'ajourd'hui en paramètre pour l'affichage de l'année en cours
        $date = new \Datetime();
        
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
    
    public function events_oldAction()
    {
        // On crée la date limite des évènements anciens (plus de 6 mois)
        $dateLimit = new \Datetime();
        $dateLimit->modify('-6 months');
        
        // On récupère toutes les annonces datants de plus de 6 mois
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('WebsiteBundle:Advert')
            ->getAdvertsAfter($dateLimit)
        ;
        
        return $this->render('WebsiteBundle:Website:events_old.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
    
    public function access_barAction()
    {
        return $this->render('WebsiteBundle:Website:access_bar.html.twig');
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
