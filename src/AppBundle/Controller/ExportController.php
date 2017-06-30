<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 14/06/2017
 * Time: 14:03
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use AppBundle\Form\Type\ObservationFilterType;

class ExportController extends Controller
{
    /**
     * @Route("/filter", name="filter")
     * @Method({"GET", "POST"})
     *
     */
    public function filterAction(Request $request)
    {
        $form = $this->createForm(ObservationFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $observations = $this->getDoctrine()->getRepository('AppBundle:Observation')
                ->getFiltrer($data);

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

        // On définit les propriétés globales du document
        $phpExcelObject->getProperties()->setCreator("Michel Dujardin")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Liste des observations")
            ->setSubject("Observations d'oiseaux")
            ->setDescription("observations d'oiseau recencées par l'assosiation NAO")
            ->setKeywords("oiseaux nao taxref")
            ->setCategory("data export");

        // On prépare le titre des colonnes
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'Date')
            ->setCellValue('C1', 'Auteur')
            ->setCellValue('D1', 'Latitude')
            ->setCellValue('E1', 'Longitude')
            ->setCellValue('F1', 'Commentaire')
            ->setCellValue('G1', 'CDNom')
            ->setCellValue('H1', 'LbNom')
            ->setCellValue('I1', 'Nom Vern');

        //ensuite on boucle pour remplir le tableau excel avec nos observations
        $i = 2;
        foreach ($observations as $observation) {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $observation->getId())
                ->setCellValue('B' . $i, $observation->getDate())
                ->setCellValue('C' . $i, $observation->getUser()->getUsername())
                ->setCellValue('D' . $i, $observation->getLatitude())
                ->setCellValue('E' . $i, $observation->getLongitude())
                ->setCellValue('F' . $i, $observation->getComment())
                ->setCellValue('G' . $i, $observation->getTaxref()->getCdnom())
                ->setCellValue('H' . $i, $observation->getTaxref()->getLbnom())
                ->setCellValue('I' . $i, $observation->getTaxref()->getNonvern());
            $i = $i + 1;
        }

        // On nomme l'onglet Actif
        $phpExcelObject->getActiveSheet()->setTitle('Export');

        // On précise quel onglet doit être ouvert lors de l'ouverture du fichier
        $phpExcelObject->setActiveSheetIndex(0);

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
