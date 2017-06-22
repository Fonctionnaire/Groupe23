<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TaxrefProtege;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class Protege extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //Attention, il faut retirer la première ligne (titre des colonnes) avant de lancer l'import
        if (($file = fopen(dirname(__FILE__).'/Resources/taxref_protege.csv', 'r')) !== FALSE) {



            while (($column = fgetcsv($file, 0, ";")) !== FALSE)
            {
                $taxrefProtege = new TaxrefProtege();
                $taxrefProtege->setNomTexte($column[0]);
                $taxrefProtege->setNomTexteFr($column[1]);
                $taxrefProtege->setNomValide($column[2]);
                $taxrefProtege->setIntitule($column[3]);
                $taxrefProtege->setArrete($column[4]);
                $taxrefProtege->setArticle($column[5]);
                $taxrefProtege->setCdnom($this->getReference('taxref'.$column[6]));
                $manager->persist($taxrefProtege);


            }
            fclose($file);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
