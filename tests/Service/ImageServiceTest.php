<?php
namespace Freyr\Tests\Service;

use Freyr\Gallery\WebBundle\Service\PhotoService;

/**
 * Class ImageServiceTest
 * @package Freyr\Tests\Service
 */
class ImageServiceTest extends ServiceTestCase
{

    /**
     *
     */
    public function testIfConstructOk()
    {
        $repositoryMock = $this->getMockBuilder('Freyr\Gallery\WebBundle\Repository\MongoDB\MongoDBPhotoRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $sut = new PhotoService($repositoryMock);
        $this->assertInstanceOf('Freyr\Gallery\WebBundle\Service\PhotoService', $sut);
    }
}
