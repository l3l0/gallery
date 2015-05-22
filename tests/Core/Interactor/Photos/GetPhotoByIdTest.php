<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotoById;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoByIdTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotoByIdTest extends PhotoTestCase
{

    /**
     *
     */
    public function testGetExistingPhoto()
    {
        $photo = $this->getSamplePhoto();
        $this->repository->store($photo);

        $interactor = new GetPhotoById($photo->getId(), $this->repository);
        $fetchedPhoto = $interactor->execute();

        $this->assertEquals($photo->getId(), $fetchedPhoto->getId());
    }

    /**
     * @expectedException \Exception
     */
    public function getNonExistingPhoto()
    {
        $interactor = new GetPhotoById(1, $this->repository);
        $interactor->execute();
    }
}
