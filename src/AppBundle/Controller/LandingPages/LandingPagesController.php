<?php

namespace AppBundle\Controller\LandingPages;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LandingPagesController extends Controller
{


    /**
     * @Route("/concours-fb-1", name="landing_page")
     * @Method({"GET"})
     */
    public function landingPagesAction()
    {

        return $this->render('landingPages/firstLandingPage.html.twig');
    }
}