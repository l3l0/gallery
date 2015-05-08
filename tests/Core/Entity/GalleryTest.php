<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
