<?php

namespace AppBundle\Controller\Dashboard;


use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use AppBundle\Entity\Observation;
use AppBundle\Form\Type\ObservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * Affiche un formulaire pour modifier une observation
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     * @Route("/Dashboard/observations/{id}/edit", requirements={"id": "\d+"}, name="edit")
     */
    public function editObservationAction(Observation $observation, Request $request)
    {
        if ($observation->getValided() === true && !$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') && $this->getUser() !== $observation->getUser()) {
            throw new AccessDeniedException("La visualisation de l'observation d'id " . $id . " est interdite");

            $entityManager = $this->getDoctrine()->getManager();
            $form = $this->createForm(ObservationType::class, $observation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
                $this->addFlash('success', 'Observation modifiée avec succès');
                return $this->redirect($this->generateUrl('viewObservation', array('id' => $observation->getId())));
            }
            return $this->render(
                'Admin/observationEdit.html.twig', [
                    'observation' => $observation,
                    'form' => $form->createView(),
                ]
            );
        }


    }
}

