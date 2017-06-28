<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{

    public function testButtonParticipe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
          0,
          $crawler->filter('html:contains("participe")')->count()
        );
    }

    public function testTitle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("NAO")')->count()
        );
    }

    public function testScrollspy()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertCount(
            1,
            $crawler->filter('img.chevron-down')
        );
    }


    public function testEncart()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertCount(
          5,
          $crawler->filter('div.encart_accueil')
        );
    }

    public function testDivDepth()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertCount(
            6,
            $crawler->filter('div.z-depth-2')
        );
    }

    public function testAddObsLink()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $link = $crawler
            ->filter('a:contains("Observations")')
            ->eq(1)
            ->link()
        ;

        $client->click($link);

        $this->assertTrue(
            $client->getResponse()->isSuccessful()
        );
    }



}
