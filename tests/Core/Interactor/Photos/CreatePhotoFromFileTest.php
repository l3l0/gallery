<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromFile;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CreatePhotoFromFileTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class CreatePhotoFromFileTest extends PhotoTestCase
{

    public function testCreateNewPhoto()
    {

        $path = __DIR__ . '/../../ImportFileWithGallery.jpg';

        $interactor = new CreatePhotoFromFile($path, $this->repository, $this->storage);
        $interactor->execute();
    }


    /**
     * @expectedException \Exception
     * @expectedExceptionCode 2
     */
    public function testCreateNewPhotoFromFileWithoutGallery()
    {
        $path = __DIR__ . '/../../ImportFileWithoutGallery.jpg';

        $interactor = new CreatePhotoFromFile($path, $this->repository, $this->storage);
        $interactor->execute();
    }
}
