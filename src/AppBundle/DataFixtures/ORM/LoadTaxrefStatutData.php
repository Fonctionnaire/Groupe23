<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TaxrefStatut as TaxrefStatut;

class Statut extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__).'/Resources/taxref_statuts.csv', 'r')) !== FALSE) {



            while (($column = fgetcsv($file, 0, ";")) !== FALSE)
            {
                $statut = new TaxrefStatut();
                $statut->setStatut($column[0]);
                $statut->setDescription($column[1]);
                $statut->setDefinition($column[2]);
                $manager->persist($statut);
                $this->addReference('statut'.$statut->getStatut(), $statut);


            }
            fclose($file);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
