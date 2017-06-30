<?php

namespace AppBundle\Controller\Mentions;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegalMentionsController extends Controller
{


    /**
     * @Route("/mentions_legales", name="legales")
     * @Method({"GET"})
     */
    public function legalMentionsAction()
    {
        return $this->render('MentionsLegales/mentionsLegales.html.twig');
    }

}
