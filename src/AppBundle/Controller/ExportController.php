<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use AppBundle\Form\Type\ObservationFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ExportController extends Controller
{
    /**
     * @Route("/export-de-donnees", name="filter")
     * @Method({"GET","POST"})
     * @Security("has_role('ROLE_ADMIN')")
     *
     */
    public function filterAction(Request $request)
    {
        $form = $this->createForm(ObservationFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // si on a selectionné des espèces dans le select, on filtre par espèce
            if (!$data['taxref']->isEmpty()) {
                $observations = $this->getDoctrine()->getRepository('AppBundle:Observation')
                    ->getFiltrer($data);

            } else { //si on n'a rien sélectionné, prend toutes les observations dans la plage de dates
                $observations = $this->getDoctrine()->getRepository('AppBundle:Observation')
                    ->getFilterWithoutTaxref($data);
            }

            //on execute l'export sur le resultat de notre requete
            return $this->exportObservationsAction($observations);
        };
        return $this->render('ExportForm/exportForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    //-------------------------------------------------
    // Autres fonctions
    //-------------------------------------------------
    /**
     * Fonction d'export Excel des observations
     * @param $observations
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportObservationsAction($observations)
    {
        // On appel de service de création de fichier Excel
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $this->get('app.export_obs')->getObsForExport($phpExcelObject, $observations);
        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'liste-observations.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }
}
