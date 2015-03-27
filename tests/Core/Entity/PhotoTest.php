<?php
namespace Freyr\Gallery\Tests\Core\Entity;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class PhotoTest
 * @package Freyr\Gallery\Tests\Core\Entity
 */
class PhotoTest extends PhotoTestCase
{

    /**
     *
     */
    public function testInitialiseNewImage()
    {
        $data = parent::prepareDataForNewPhoto();

        $photo = new Photo($data);
        $this->assertEquals($data['name'], $photo->getName());
        $this->assertEquals($data['url'], $photo->getUrl());

        foreach ($photo->getTags() as $key => $tag) {
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Tag', $tag);
            $this->assertEquals(strtolower(str_replace(' ', '-', trim($data['tags'][$key]['name']))), $tag->getName());
        }

        $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Gallery', $photo->getGallery());
        $this->assertEquals('gallery1', $photo->getGallery()->getName());
        $this->assertNull($photo->getId());
        $this->assertNull($photo->getCloudId());
    }

    public function testInitializeExistingImage()
    {
        $data = parent::prepareDataForNewPhoto();
        $data['id'] = uniqid();
        $data['cloudId'] = uniqid();

        $photo = new Photo($data);
        $this->assertNotNull($photo->getId());
        $this->assertNotNull($photo->getCloudId());
    }
}
