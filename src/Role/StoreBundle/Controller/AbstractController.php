<?php

namespace Role\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Role\StoreBundle\Document\Offer;
use Role\StoreBundle\Form\OfferType;

/**
 * Store Abstract controller.
 */
class AbstractController extends Controller
{

	protected function getStore(){
	
		$store = $this->getUser()->getRoleStore();
        if(!$store){
            throw new \Exception("Su sesión ha caducado");
        }
        return $store;
	}

}
