<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactController extends Controller
{
    /**
     * @Route("/nous_contacter", name="nous_contacter")
     * @Method({"GET","POST"})
     */
    public function contactAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array(
                'constraints' => array(new NotBlank(),
                new Length(array('min' => 2)),
            )))
            ->add('firstName', TextType::class, array(
                'constraints' => array( new NotBlank(),
                new Length(array('min' => 2)),
            )))
            ->add('mail', EmailType::class, array(
                'constraints' => array( new Email(),
                new NotBlank(),
            )))
            ->add('subject', TextType::class, array(
                'constraints' => array( new NotBlank(),
                new Length(array('min' => 2)),
            )))
            ->add('message', TextareaType::class, array(
                'constraints' => array( new NotBlank(),
                new Length(array('min' => 2)),
            )))
            ->add('envoyer', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->get('app.send_contact_mail')->sendContactMail($data);

            $request->getSession()->getFlashbag()->add('success', 'Votre message à bien été envoyé. Nous vous répondrons au plus vite.');
            return $this->redirectToRoute('nous_contacter');
    }
        return $this->render(':Contact:contact.html.twig', array('form' => $form->createView()));
    }
}
