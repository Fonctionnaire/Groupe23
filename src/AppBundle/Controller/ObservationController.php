<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use AppBundle\Entity\Observation;
use AppBundle\Form\ObservationType;
use AppBundle\Entity\Taxref;
use UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

class ObservationController extends BaseController
{



    /**
     * @Route("/addObservation", name="addObservation")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function addObservationAction(Request $request)
    {
        // Création de l'entité Observation
        $observation = new Observation();
        $observation->setDate(new \Datetime);


        $observation->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $file = $observation->getImage();

            // Generate a unique name for the file before saving it
            $fileName = $this->get('app.image_uploader')->upload($file);

            $observation->setImage($fileName);


            // On récupère l'EntityManager
            $em = $this->getDoctrine()->getManager();
            // Étape 1 : On « persiste » l'entité
            $em->persist($observation);
            // Étape 2 : On « flush » tout ce qui a été persisté avant
            $em->flush();

            return $this->redirect($this->generateUrl('viewObservation', array('id' => $observation->getId())));
        }

        return $this->render('default/addObservation.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/viewObservation/{id}", name="viewObservation")
     * @Method({"GET", "POST"})
     */
    public function viewObservationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $observation = $em->getRepository('AppBundle:Observation')->find($id);

        // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id n'existe pas, d'où ce if :
        if (null === $observation) {
            throw new NotFoundHttpException("L'observation d'id ".$id." n'existe pas.");
        }



        return $this->render('default/viewObservation.html.twig', array(
            'observation'           => $observation,
        ));
    }





}
