<?php

namespace Tests\AppBundle\Controller\Taxrefs;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaxrefsControllerTest extends WebTestCase
{

    public function testDivMap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/observations_validées');

        $this->assertGreaterThan(0,
            $crawler->filter('div#map-view')->count()
            );

    }

    public function testTh()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/observations_validées');

        $this->assertGreaterThanOrEqual(
            9,
            $crawler->filter('th')->count()
        );
    }

    public function testHtmlTab()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/observations_validées');

        $this->assertGreaterThan(0,
            $crawler->filter('th:contains("Nom")')->count()
            );
    }


}
