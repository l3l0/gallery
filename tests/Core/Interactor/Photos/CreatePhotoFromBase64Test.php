<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromBase64;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CreatePhotoFromBase64Test
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class CreatePhotoFromBase64Test extends PhotoTestCase
{

    public function testCreateNewPhoto()
    {
        $data = $this->generateBase64PhotoData();
        $interactor = new CreatePhotoFromBase64($data, $this->repository, $this->storage);
        $interactor->execute();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 2
     */
    public function testValidationEmptyGallery()
    {
        $data = $this->generateBase64PhotoData();
        array_pop($data['lightroomTags']);
        $interactor = new CreatePhotoFromBase64($data, $this->repository, $this->storage);
        $interactor->execute();
    }
}
