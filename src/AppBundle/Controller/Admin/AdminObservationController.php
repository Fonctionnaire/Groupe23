<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Form\Type\ObservationEditType;
use AppBundle\Entity\Observation;
use AppBundle\Form\Type\ObservationStatutType;
use AppBundle\Form\Type\ObservationValidationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminObservationController extends Controller
{

    /**
     * Voire toutes les observations
     * @Route("/admin/observations", name="adminObservations")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewObservationsAction()
    {
        $listobservations = $this->getDoctrine()->getRepository("AppBundle:Observation")->myfindAll();
        return $this->render(':Admin:observations.html.twig', array('listObservations' => $listobservations,));
    }

    /**
     * Supprime une observation
     * @Route("/admin/observation/{id}/supprimer", name="deleteObservation")
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
     * Affiche un formulaire pour modifier une observation
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/admin/observation/{id}/editer", requirements={"id": "\d+"}, name="edit")
     */
    public function editObservationAction(Observation $observation, Request $request)
    {
        $observation->setAdminUsername($this->get('security.token_storage')->getToken()->getUser()->getUsername());
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ObservationEditType::class, $observation);
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

    /**
     * Affiche un formulaire pour valider une observation
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/admin/observation/{id}/validation", name="validation")
     */
    public function validationObservationAction(Observation $observation, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ObservationValidationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $observation->setWaiting(false);
            $observation->setAdminUsername($this->get('security.token_storage')->getToken()->getUser()->getUsername());
            $entityManager->flush();
            $this->addFlash('success', 'Observation traitée avec succès');
            return $this->redirect($this->generateUrl('adminObservations'));
        }

        return $this->render('Admin/validationForm.html.twig', array(
            'form' => $form->createView(),
            'observation' => $observation,
        ));
    }

    /**
     * Affiche un formulaire pour modifier le statut de l'observation
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     * @Route("/admin/observation/{id}/statut", name="statut")
     */
    public function observationStatutAction(Observation $observation, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ObservationStatutType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($observation->getValided() === false && $observation->getVisible() === true) {
                $this->addFlash('warning', 'Vous ne pouvez publier une observation invalide');
                return $this->redirect($this->generateUrl('edit', array('id' => $observation->getId())));
            }
            $observation->setAdminUsername($this->get('security.token_storage')->getToken()->getUser()->getUsername());
            $entityManager->flush();
            $this->addFlash('success', 'Statut modifié avec succès' );
            return $this->redirect($this->generateUrl('edit', array('id' => $observation->getId())));

        }

        return $this->render('Admin/ObservationStatutForm.html.twig', array(
            'form' => $form->createView(),
            'observation' => $observation,
        ));
    }
}
