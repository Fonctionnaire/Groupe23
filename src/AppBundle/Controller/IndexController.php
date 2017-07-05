<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends BaseController
{
    /**
     * @Method("GET")
     * @Route("/", name="index")
     */
    public function accueilAction()
    {
        return $this->render(':Index:index.html.twig');
    }
}
