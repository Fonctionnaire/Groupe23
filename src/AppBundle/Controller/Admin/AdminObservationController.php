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
     * @Method("POST")
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
     * validation rapide d'une observation
     * @Route("/admin/observation/{id}/valider", name="valider")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function validerObservationAction(Observation $observation, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();

        if (!$observation->getValided()){ //si l'observation n'est pas déja validée
            if ($observation->getWaiting()){ // si elle est en attente, je redirige sur la page de l'observation
                return $this->redirect($this->generateUrl('viewObservation', array('id' => $observation->getId())));
            }
            $observation->setValided(true);
            $request->getSession()->getFlashbag()->add('success', 'L\'observation a été validée');
        }
        else{
            $observation->setValided(false)->setVisible(false);
            $request->getSession()->getFlashbag()->add('success', 'L\'observation a été invalidée');
        }
        $entityManager->flush();
        return $this->redirect($referer);
    }
    /**
     * rendre une observation visible rapidement
     * @Route("/admin/observation/{id}/visible", name="visible")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function setVisibleObservationAction(Observation $observation, Request $request)
    {
        $referer = $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        if($observation->getVisible()){
            $observation->setVisible(false);
            $entityManager->flush();
            $request->getSession()->getFlashbag()->add('success', 'L\'observation n\'est plus publique');
            return $this->redirect($referer);
        }
        elseif (!$observation->getValided())
        {
            $request->getSession()->getFlashbag()->add('danger', 'Une observation no validée ne peut pas être visible !');
            return $this->redirect($referer);
        }
        else{
            $observation->setVisible(true);
            $entityManager->flush();
            $request->getSession()->getFlashbag()->add('success', 'L\'observation est publique');
            return $this->redirect($referer);
        }


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
            if ($observation->getValided() === false && $observation->getVisible() === true) {
                $this->addFlash('warning', 'Vous ne pouvez publier une observation invalide');
                return $this->redirect($this->generateUrl('viewObservation', array('id' => $observation->getId())));
            }
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
}
