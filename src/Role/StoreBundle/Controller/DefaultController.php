<?php

namespace Role\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
	
	
	/**
	* @Route("/terkminiosycondiciones",name="controller_terminiosycondiciones")
	* @Template()
	*/
	public function terminiosycondicionesAction()
	{
		
	}
	
}