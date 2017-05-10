<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ListTaxrefsController extends BaseController
{
    /**
     * @return Response
     * @Method("GET")
     * @Route("/listTaxrefs", name="listTaxrefs")
     */
    public function listTaxrefsAction()
    {
        $listtaxrefs = $this->getDoctrine()->getRepository("AppBundle:Taxref")->findAll();
        return $this->render('default/especes.html.twig', array('listTaxrefs' => $listtaxrefs,));
    }
}
