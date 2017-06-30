<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 29/06/2017
 * Time: 19:09
 */

namespace Tests\AppBundle\Controller\Taxrefs;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ViewObsUserControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testDivMap()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/user/observations_validées');

        $this->assertGreaterThan(0,
            $crawler->filter('div#map-view')->count()
        );

    }

    public function testTh()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/user/observations_validées');

        $this->assertGreaterThanOrEqual(
            9,
            $crawler->filter('th')->count()
        );
    }

    public function testHtmlTab()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/user/observations_validées');

        $this->assertGreaterThan(0,
            $crawler->filter('th:contains("Nom")')->count()
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