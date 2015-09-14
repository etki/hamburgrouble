<?php

namespace Etki\Projects\HHamburgrouble\HamburgroubleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EtkiHamburgroubleBundle:Master:index.html.twig', array('name' => $name));
    }
}
