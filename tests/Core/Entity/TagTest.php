<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Tests\Core\Entity;

use Freyr\Gallery\Core\Entity\CoverPhoto;
use Freyr\Gallery\Core\Entity\Tag;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class TagTest
 * @package Freyr\Gallery\Tests\Core\Entity
 */
class TagTest extends PhotoTestCase
{

    /**
     *
     */
    public function testInitialiseNewImage()
    {
        $photo = $this->getSamplePhoto();

        foreach ($photo->getTags() as $key => $tag) {
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Tag', $tag);
            $this->assertFalse(strpos($tag->getName(), ' '));
        }
    }

    public function testInitialisationOfAnTag()
    {
        $tag = new Tag('testTagName');
        $this->assertInstanceOf('\Freyr\Gallery\Core\Entity\Tag', $tag);
        $this->assertEquals('testtagname', $tag->getName());

        $photo = $this->getSamplePhoto();

        $coverPhoto = new CoverPhoto($photo);
        $tag->setCoverPhoto($coverPhoto);
        $this->assertInstanceOf('\Freyr\Gallery\Core\Entity\CoverPhoto', $tag->getCoverPhoto());

    }
}
