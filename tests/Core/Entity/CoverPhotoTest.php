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
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CoverPhotoTest
 * @package Freyr\Gallery\Tests\Core\Entity
 */
class CoverPhotoTest extends PhotoTestCase
{

    /**
     *
     */
    public function testInitialiseNewImage()
    {
        $photo = $this->getSamplePhoto();

        $coverPhoto = new CoverPhoto($photo);
        $this->assertEquals('smallUrl', $coverPhoto->getUrl());
    }
}
