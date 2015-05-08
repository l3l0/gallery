<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotosFromGallery;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoFromGalleryTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotosFromGalleryTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $this->loadFixture(100, ['One', 'Two', 'three'], ['uno', 'duo', 'single', 'double', 'triple', 'octo']);

        $interactor = new GetPhotosFromGallery('one', $this->repository);
        $galleries = $interactor->execute();
        $this->assertNotEmpty($galleries);
    }
}