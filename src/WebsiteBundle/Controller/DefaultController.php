<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebsiteBundle:Default:index.html.twig');
    }
    
    public function access_barAction()
    {
        return $this->render('WebsiteBundle:Default:access_bar.html.twig');
    }
    
    public function relation_aideAction()
    {
        return $this->render('WebsiteBundle:Default:relation_aide.html.twig');
    }
    
    public function sophrologieAction()
    {
        return $this->render('WebsiteBundle:Default:sophrologie.html.twig');
    }
    
    public function mon_approcheAction()
    {
        return $this->render('WebsiteBundle:Default:mon_approche.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('WebsiteBundle:Default:contact.html.twig');
    }
    
    public function events_oldAction()
    {
        return $this->render('WebsiteBundle:Default:events_old.html.twig');
    }
}
