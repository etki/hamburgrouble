<?php

namespace Etki\HamburgroubleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EtkiHamburgroubleBundle:Default:index.html.twig', array('name' => $name));
    }
}
