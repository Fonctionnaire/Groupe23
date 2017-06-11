<?php

namespace AppBundle\Controller\Dashboard;


use AppBundle\Form\ObservationFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use AppBundle\Entity\Observation;
use AppBundle\Form\ObservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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
            'listObservations' => $listObservations));
    }

    /**
     * Voir profil
     * @Route("/Dashboard/profil", name="dashboardProfil")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function viewProfilAction()
    {
        $user = $this->getUser();
        $user->getEmail();
        return $this->render(":Dashboard:profil.html.twig", array(
            'user' => $user
        ));

    }
}