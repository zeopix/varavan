<?php

namespace Role\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="store")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/app")
     * @Template()
     */
    public function appAction()
    {
        return array();
    }
}
