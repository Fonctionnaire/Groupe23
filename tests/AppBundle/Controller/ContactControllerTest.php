<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 28/06/2017
 * Time: 14:57
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nous-contacter');

        $buttonCrawlerNode = $crawler->selectButton('Envoyer');

        $form = $buttonCrawlerNode->form(array(
            'contact[name]' => 'test',
            'contact[firstName]' => 'test',
            'contact[mail]' => 'test@gmail.com',
            'contact[subject]' => 'test',
            'contact[message]' => 'test'
        ));

        $client->submit($form);
        $this->assertEquals(302,
            $client->getResponse()->getStatusCode());

    }

}
