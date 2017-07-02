<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/06/2017
 * Time: 19:16
 */

namespace AppBundle\Services\ContactMail;




class ContactMail extends \Twig_Extension
{

    private $twig;
    private $mailer;

    public function __construct(\Swift_Mailer $mailer,\Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function sendContactMail($data)
    {
        $reply = $data['mail'];
        $message = \Swift_Message::newInstance()->setSubject('Contact')
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo(['thibaut.gruffy@gmail.com', $reply])
            ->setBody($this->twig->render(
                ':Emails:contactMail.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'subject' => $data['subject'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendContactMailToSender($data)
    {
        $reply = $data['mail'];
        $message = \Swift_Message::newInstance()->setSubject('Contact')
            ->setFrom('gruffy.thibaut@gmail.com')
            ->setTo($reply)
            ->setBody($this->twig->render(
                ':Emails:contactMailForSender.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'subject' => $data['subject'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
