<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends BaseController
{
    /**
     * @return Response
     * @Method("GET")
     * @Route("/", name="index")
     */
    public function accueilAction()
    {
        $content = $this
            ->get('templating')
            ->render('Index/index.html.twig', array('message' => 'Hello Groupe 23 !'));
        return new Response($content);
    }
}
