<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Form\ObservationEditType;
use AppBundle\Entity\Observation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminObservationController extends Controller
{


    /**
     *--------------------------------------------------------------------------------------------------------------
     *==============   PARTIE ADMIN   ======================================================================
     * -------------------------------------------------------------------------------------------------------------
     */


    /**
     * Voire toutes les observations
     * @Route("/admin/observations", name="adminObservations")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewObservationsAction()
    {
        $listobservations = $this->getDoctrine()->getRepository("AppBundle:Observation")->findAll();
        return $this->render('Admin/observations.html.twig', array('listObservations' => $listobservations,));
    }

    /**
     * Supprime une observation
     * @Route("/admin/{id}/delete", name="deleteObservation")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteObservationAction(Observation $observation, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($observation);
        $entityManager->flush();
        $request->getSession()->getFlashbag()->add('success', 'L\'observation a été Supprimée');
        return $this->redirect($referer);
    }


    /**
     * Valide une observation
     * @Method({"GET"})
     * @Route("/admin/{id}/valid", name="validObservation")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function validObservation(Observation $observation, Request $request)
    {
        $referer = $request->headers->get('referer');
        $observation->setValided('1');
        $em = $this->getDoctrine()->getManager();
        $em->persist($observation);
        $em->flush();
        $request->getSession()->getFlashbag()->add('success', 'Le commentaire a été validé');
        return $this->redirect($referer);}

    /**
     * Affiche un formulaire pour modifier une observation
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="edit")
     */
    public function editAction(Observation $observation, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ObservationEditType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Observation modifiée avec succès');
            return $this->redirect($referer);

        }

        return $this->render(
            'Admin/observationEdit.html.twig',
            [
                'observation' => $observation,
                'form' => $form->createView(),
            ]
        );
    }
}
