<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\Photos\AddImageAsPhoto;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class AddImageAsPhotoTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class AddImageAsPhotoTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $apiData = [
            "urls" => [Photo::THUMBNAIL_STANDARD => 'standardUrl', Photo::THUMBNAIL_SMALL => 'smallUrl'],
            "tags" => ['uno', 'duo']
        ];

        $interactor = new AddImageAsPhoto($apiData['tags'], $apiData['urls'], $this->repository);
        $expected = $interactor->execute();
        $actual = $this->repository->findById($expected->id);

        $this->assertEquals($expected->id, $actual->getId());
    }

}
