<?php

namespace AppBundle\Services;


use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Observation;
use UserBundle\Entity\User;



class Notification extends \Twig_Extension
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var
     */
    private $em;
    /**
     * @var
     */
    private $twig;




    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
        $this->twig = $twig;

    }

    //Envoi d'un mail à un observateur lors d'une observation
    public function sendMailPostObservation(Observation $observation)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('NA0 : Votre observation est enregistrée')
            ->setFrom(array('noreply.naoasso@gmail.com' => 'Association NAO'))
            ->setTo($observation->getUser()->getEmail())
            ->setBody(
                $this->twig->render('Emails/mailPostObservation.html.twig', array('observation' => $observation)), 'text/html')
        ;
        $this->mailer->send($message);
    }

    //Envoi d'un mail aux administrateurs lors d'une nouvelle observation
    public function sendMailNewObservation(Observation $observation, User $user)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('Nouvelle Observation')
            ->setFrom(array('noreply.naoasso@gmail.com' => 'Association NAO'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->twig->render('Emails/mailNewObservation.html.twig', array(
                    'user' => $user,
                    'observation' => $observation
                )), 'text/html')
        ;
        $this->mailer->send($message);

    }

}