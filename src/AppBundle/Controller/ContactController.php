<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/nous_contacter", name="nous_contacter")
     * @Method({"GET","POST"})
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->get('app.send_contact_mail')->sendContactMail($data);

            $this->addFlash('success', 'Votre message à bien été envoyé. Nous vous répondrons au plus vite.');
            return $this->redirectToRoute('nous_contacter');
    }
        return $this->render(':Contact:contact.html.twig', array('form' => $form->createView()));
    }
}
