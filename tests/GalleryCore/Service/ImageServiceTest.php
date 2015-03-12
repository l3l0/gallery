<?php
namespace Freyr\Tests\GalleryCore\Service;

use Freyr\GalleryCore\Service\ImageService;

class ImageServiceTest extends ServiceTestCase {

    public function testIfConstructOk()
    {
        $repositoryMock = $this->getMockBuilder('Freyr\GalleryCore\Repository\ImageRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $keywordFactoryMock = $this->getMockBuilder('Freyr\GalleryCore\Service\KeywordFactory')
            ->disableOriginalConstructor()
            ->getMock();
        $galleryFactoryMock = $this->getMockBuilder('Freyr\GalleryCore\Service\GalleryFactory')
            ->disableOriginalConstructor()
            ->getMock();
        $sut = new ImageService($repositoryMock, $keywordFactoryMock, $galleryFactoryMock);
    }
}
