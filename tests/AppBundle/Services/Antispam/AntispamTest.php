<?php

namespace Tests\AppBundle\Services\Antispam;




use AppBundle\Entity\Article;
use AppBundle\Services\Antispam\Antispam;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;

class AntispamTest extends TestCase
{
    /**
     * @var Antispam
     */
    private $service;

    protected function setUp()
    {
        $article = new Article();

        $article->setContent("Lorem ipsum");

        $commentRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $commentRepository->expects($this->any())
            ->method('find')
            ->will($this->returnValue($article));

        $em = $this
            ->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($commentRepository));

        $this->service = new Antispam($em);

    }

    public function testTextWithUrl()
    {

        $comment = "http://www.orange.fr/portail";

        $this->assertNotTrue($this->service->isSpam($comment));

    }
}
