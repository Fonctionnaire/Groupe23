<?php

namespace Tests\AppBundle\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DashboardControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testContainer()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/profile/');

        $this->assertGreaterThan(0,
            $crawler->filter('div.container')->count()
            );
    }

    public function testTitreProfil()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/profile/');


        $this->assertGreaterThan(0,
            $crawler->filter('h1')->count());
    }

    public function testClickLinkModif()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/profile/');

        $link = $crawler
            ->filter('a')
            ->eq(2)
            ->link()
        ;

        $this->client->click($link);

        $this->assertTrue(
            $this->client->getResponse()->isSuccessful()
        );
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context defaults to the firewall name
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallContext, array('ROLE_USER'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

}