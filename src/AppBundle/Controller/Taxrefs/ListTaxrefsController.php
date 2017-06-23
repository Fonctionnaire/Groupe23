<?php

namespace AppBundle\Controller\Taxrefs;

use AppBundle\Entity\Taxref;
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
        $listtaxrefs = $this->getDoctrine()->getRepository("AppBundle:Taxref")->getBirdsWithObservation();

        return $this->render('Especes/especes.html.twig', array('listTaxrefs' => $listtaxrefs));
    }
}
