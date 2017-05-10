<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TaxrefRang as TaxrefRang;

class Rang extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__).'/Resources/rangs_note.csv', 'r')) !== FALSE) {

            while (($column = fgetcsv($file, 0, ";")) !== FALSE)
            {
                $rang = new TaxrefRang();
                $rang->setRang($column[0]);
                $rang->setDetail($column[1]);
                $manager->persist($rang);
                $this->addReference('rang'.$rang->getRang(), $rang);


            }
            fclose($file);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
