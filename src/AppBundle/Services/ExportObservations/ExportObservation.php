<?php

namespace AppBundle\Services\ExportObservations;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExportObservation extends Controller
{

    public function getObsForExport($phpExcelObject, $observations)
    {

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

        return $phpExcelObject;
    }

}
