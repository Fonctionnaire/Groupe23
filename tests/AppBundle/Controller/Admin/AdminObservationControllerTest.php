<?php

namespace Tests\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminObservationControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testHtmlGestion()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/observations');


        $this->assertGreaterThan(0,
            $crawler->filter('html:contains("gestion")')->count());
    }

    public function testTab()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/observations');

        $this->assertCount(1,
            $crawler->filter('div.material-table')
            );
    }

    public function testLinkView()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/observations');

        $this->assertGreaterThan(
          3,
          $crawler->filter('a.modal-trigger')->count()
        );
    }

    public function testClickLink()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/observations');

        $link = $crawler
            ->filter('a.modal-trigger')
            ->eq(1)
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

        $token = new UsernamePasswordToken('admin', null, $firewallContext, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

}
