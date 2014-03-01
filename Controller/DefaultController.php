<?php

namespace Site\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SiteUtilityBundle:Default:index.html.twig', array('name' => $name));
    }
}
