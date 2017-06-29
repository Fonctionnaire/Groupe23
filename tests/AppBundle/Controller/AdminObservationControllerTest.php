<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminObservationControllerTest extends WebTestCase
{

    public function testViewObservationTable()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/observations');

        $this->assertGreaterThan(
            0,
            $crawler->filter('div')->count()
        );

    }

}