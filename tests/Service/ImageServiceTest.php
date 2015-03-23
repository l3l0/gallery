<?php
namespace Freyr\Tests\Service;

use Freyr\Gallery\GalleryBundle\Service\PhotoService;

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
        $repositoryMock = $this->getMockBuilder('Freyr\GalleryBundle\Repository\MongoDBPhotoRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $sut = new PhotoService($repositoryMock);
        $this->assertInstanceOf('Freyr\GalleryBundle\Service\PhotoService', $sut);
    }
}
