<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 13/06/2017
 * Time: 13:32
 */

namespace AppBundle\Controller\Taxrefs;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ViewObsUserController extends Controller
{
    /**
     * @return Response
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     * @Route("/utilisateur/observations-validees", name="user_listTaxrefs")
     */
    public function userListTaxrefsAction()
    {
        $listtaxrefs = $this->getDoctrine()->getRepository("AppBundle:Taxref")->getBirdsWithObservation();

        return $this->render('ViewAllObsValided/especesUser.html.twig', array('listTaxrefs' => $listtaxrefs));
    }
}
