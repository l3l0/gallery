<?php
namespace Freyr\Gallery\Tests\Core\Entity;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GalleryTest
 * @package Freyr\Gallery\Tests\Core\Entity
 */
class GalleryTest extends PhotoTestCase
{
    public function testInitialiseNewGallery()
    {
        $data = [
            'name' => 'Gallery Test'
        ];

        $gallery = new Gallery($data);
        $this->assertEquals('gallery-test', $gallery->getName());
    }
}
