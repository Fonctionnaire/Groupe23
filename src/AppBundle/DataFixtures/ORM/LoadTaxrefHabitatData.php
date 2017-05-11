<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TaxrefHabitat as TaxrefHabitat;

class Habitat extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__).'/Resources/taxref_habitat.csv', 'r')) !== FALSE) {



            while (($column = fgetcsv($file, 0, ";")) !== FALSE)
            {
                $habitat = new TaxrefHabitat();
                $habitat->setHabitatId($column[0]);
                $habitat->setDescription($column[1]);
                $habitat->setRemarques($column[2]);
                $manager->persist($habitat);
                $this->addReference('habitat'.$column[0], $habitat);


            }
            fclose($file);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
