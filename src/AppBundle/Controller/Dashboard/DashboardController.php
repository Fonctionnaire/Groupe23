<?php

namespace AppBundle\Controller\Dashboard;


use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DashboardController extends Controller
{

    /**
     * Voir ses observations
     * @Route("/Dashboard/observations", name="dashboardObservations")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function viewObservationsAction()
    {
        $user = $this->getUser();
        $listObservations = $this->getDoctrine()->getRepository("AppBundle:Observation")->findBy(
            array('user' => $user)
        );
        return $this->render('Dashboard/dashboard.html.twig', array(
            'user' => $user,
            'listObservations' => $listObservations
        ));
    }


}
