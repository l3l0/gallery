<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->assertEquals('galleryname', $photo->getGallery()->getName());
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

    public function testConversionToResponseModel()
    {
        $data = [
            'name' => 'Name',
            'url' => 'url',
            'tags' => [
                ['name' => 'one']
            ],
            'gallery' => ['name' => 'GalleryName'],
        ];

        $photo = new Photo($data);
        $this->repository->store($photo);
        $responsePhoto = $photo->asDataStructure();
        $this->assertArrayHasKey('tags', $responsePhoto);
        foreach ($responsePhoto['tags'] as $tag) {
            $this->assertEquals('one', $tag['name']);
        }
        $this->assertEquals('galleryname', $responsePhoto['gallery']['name']);
        $this->assertEquals('Name', $responsePhoto['name']);
        $this->assertEquals('url', $responsePhoto['url']);

    }
}
