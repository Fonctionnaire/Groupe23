<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Taxref as Taxref;

class TaxrefData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__) . '/Resources/taxrefdata.csv', 'r')) !== FALSE) {

            $i = 0;

            while (($column = fgetcsv($file, 0, ";")) !== FALSE) {
                $taxref = new Taxref();
                $taxref->setRegne($column[0]);
                $taxref->setPhylum($column[1]);
                $taxref->setClasse($column[2]);
                $taxref->setOrdre($column[3]);
                $taxref->setFamille($column[4]);
                $taxref->setCdnom($column[5]);
                $taxref->setCdtaxsup($column[6]);
                $taxref->setCdref($column[7]);
                $taxref->setRang($this->getReference('rang' . $column[8]));
                $taxref->setLbnom($column[9]);
                $taxref->setLbauteur($column[10]);
                $taxref->setNomcomplet($column[11]);
                $taxref->setNomvalide($column[12]);
                $taxref->setNonvern($column[13]);
                $taxref->setNomverneng($column[14]);

                $taxref->setHabitat($this->getReference('habitat' . $column[15]));

                if (!empty($column[16])) {
                    $taxref->setFrStatut($this->getReference('statut' . $column[16]));
                }
                if (!empty($column[17])) {
                    $taxref->setGfStatut($this->getReference('statut' . $column[17]));
                }
                if (!empty($column[18])) {
                    $taxref->setMarStatut($this->getReference('statut' . $column[18]));
                }
                if (!empty($column[19])) {
                    $taxref->setGuaStatut($this->getReference('statut' . $column[19]));
                }
                if (!empty($column[20])) {
                    $taxref->setSmStatut($this->getReference('statut' . $column[20]));
                }
                if (!empty($column[21])) {
                    $taxref->setSbStatut($this->getReference('statut' . $column[21]));
                }
                if (!empty($column[22])) {
                    $taxref->setSpmStatut($this->getReference('statut' . $column[22]));
                }
                if (!empty($column[23])) {
                    $taxref->setMayStatut($this->getReference('statut' . $column[23]));
                }
                if (!empty($column[24])) {
                    $taxref->setEpaStatut($this->getReference('statut' . $column[24]));
                }
                if (!empty($column[25])) {
                    $taxref->setReuStatut($this->getReference('statut' . $column[25]));
                }
                if (!empty($column[26])) {
                    $taxref->setSaStatut($this->getReference('statut' . $column[26]));
                }
                if (!empty($column[27])) {
                    $taxref->setTaStatut($this->getReference('statut' . $column[27]));
                }
                if (!empty($column[28])) {
                    $taxref->setTaafStatut($this->getReference('statut' . $column[28]));
                }
                if (!empty($column[29])) {
                    $taxref->setNcStatut($this->getReference('statut' . $column[29]));
                }
                if (!empty($column[30])) {
                    $taxref->setWfStatut($this->getReference('statut' . $column[30]));
                }
                if (!empty($column[31])) {
                    $taxref->setCliStatut($this->getReference('statut' . $column[31]));
                }
                if (!empty($column[33])) {

                    $taxref->setLink($column[33]);
                }

                if (!empty($column[34])) {

                    $taxref->setProtected($column[34]);
                }


                $manager->persist($taxref);
                $this->addReference('taxref'.$column[5], $taxref);
                $i++;
                if($i % 25 == 0){
                    $manager->flush();
                    $manager->clear();
                }

            }
            fclose($file);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
