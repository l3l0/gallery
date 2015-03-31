<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotosByTags;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotosByTagsTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotosByTagsTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $this->loadFixture(100, ['One', 'Two', 'three'], ['uno', 'duo', 'single', 'double', 'triple', 'octo']);

        $tags = ['uno', 'duo'];
        $interactor = new GetPhotosByTags($tags, $this->repository);
        $result = $interactor->execute();
        $this->assertNotEmpty($result);

        $tags = ['sadfas'];
        $interactor = new GetPhotosByTags($tags, $this->repository);
        $result = $interactor->execute();
        $this->assertEmpty($result);
    }

}