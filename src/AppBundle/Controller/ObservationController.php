<?php

namespace AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use AppBundle\Entity\Observation;
use AppBundle\Form\Type\ObservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class ObservationController extends BaseController
{


    /**
     * @Route("/nouvelle-observation", name="addObservation")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function addObservationAction(Request $request)
    {
        // Création de l'entité Observation
        $observation = new Observation();

        $observation->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        $role = $this->get('security.token_storage')->getToken()->getUser()->getRoles();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($role[0] == "ROLE_ADMIN" || $role[0] == "ROLE_SUPER_ADMIN")
            {
                $observation->setValided(true);
                $observation->setWaiting(false);
            }
            $em->persist($observation);
            $em->flush();

            $listAdmins = $em->getRepository('UserBundle:User')->findByRole("ROLE_ADMIN");
            foreach ($listAdmins as $user)
            {
                $this->get('app.notification')->sendMailNewObservation($observation, $user);
            }

            return $this->redirect($this->generateUrl('viewObservation', array('id' => $observation->getId())));
        }

        return $this->render(':AddObservation:addObservation.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/voir-observation/{id}", name="viewObservation", options={"expose"=true})
     * @Method({"GET"})
     */
    public function viewObservationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $observation = $em->getRepository('AppBundle:Observation')->find($id);
        if($observation->getTaxref()->getProtected())
        {
            $request->getSession()->getFlashbag()->add('danger', 'Cette espèce est protégée !');
        }


        if (null === $observation) {
            throw new NotFoundHttpException("L'observation d'id " . $id . " n'existe pas.");
        }
        if (!$observation->getValided() === true && !$observation->getVisible() === true && !$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') && $this->getUser() !== $observation->getUser()){
            throw new AccessDeniedException("La visualisation de l'observation d'id ". $id . " est interdite");
        }



        return $this->render('ViewUniqueObs/viewObservation.html.twig', array(
            'observation' => $observation,
        ));
    }

    /**
     * @Route("/observationModale/{id}", options={"expose"=true} , name="observationModale")
     * @Method({"GET"})
     */
    public function observationModaleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $observation = $em->getRepository('AppBundle:Observation')->find($id);


        if (null === $observation) {
            throw new NotFoundHttpException("L'observation d'id " . $id . " n'existe pas.");
        }


        return $this->render(':Admin:observationModale.html.twig', array(
            'observation' => $observation,
        ));
    }
}
