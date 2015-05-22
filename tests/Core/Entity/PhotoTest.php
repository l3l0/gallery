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
        $photo = new Photo();
        $this->assertInstanceOf('\Freyr\Gallery\Core\Entity\Photo', $photo);

        $photo->setTags(['tag1  ', 'tag2', 'tag 3']);
        $this->assertCount(3, $photo->getTags());

        $this->assertEmpty($photo->getId());
        $photo->setId(4);
        $this->assertEquals(4, $photo->getId());

        $this->assertEmpty($photo->getThumbnails());
        $photo->setUrl('test', Photo::THUMBNAIL_STANDARD);
        $this->assertCount(1, $photo->getThumbnails());
        $this->assertArrayHasKey(Photo::THUMBNAIL_STANDARD, $photo->getThumbnails());
        $thumb = $photo->getUrl(Photo::THUMBNAIL_STANDARD);
        $this->assertEquals('test', $thumb);

        $photo->setThumbnails([Photo::THUMBNAIL_STANDARD => 'standardUrl', Photo::THUMBNAIL_SMALL => 'smallUrl']);
        $this->assertCount(2, $photo->getThumbnails());
        $this->assertEquals('smallUrl', $photo->getUrl(Photo::THUMBNAIL_SMALL));
    }
}
