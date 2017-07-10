<?php

namespace AppBundle\Controller\Taxrefs;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ListTaxrefsController extends BaseController
{
    /**
     * @return Response
     * @Method("GET")
     * @Route("/observations-validees", name="listTaxrefs")
     */
    public function listTaxrefsAction()
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $this->redirectToRoute('admin_listTaxrefs');
        }
        elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            $this->redirectToRoute('user_listTaxrefs');
        }
        $listtaxrefs = $this->getDoctrine()->getRepository("AppBundle:Taxref")->getBirdsWithObservationPublic();

        return $this->render('ViewAllObsValided/especes.html.twig', array('listTaxrefs' => $listtaxrefs));
    }
}
