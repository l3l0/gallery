<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromFile;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CreatePhotoFromFileTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class CreatePhotoFromFileTest extends PhotoTestCase
{

    public function testCreateNewPhoto()
    {
        $interactor = new CreatePhotoFromFile($this->repository, $this->storage);

        $requestModel = new PhotoRequestModel();
        $requestModel->url = __DIR__ . '/../../ImportFileWithGallery.jpg';
        $requestModel->name = 'photoName';

        $interactor->setRequestModel($requestModel);
        $interactor->execute();
    }

    /**
     * @expectedException \Exception
     */
    public function testCreateNewPhotoFromFileWithoutGallery()
    {
        $interactor = new CreatePhotoFromFile($this->repository, $this->storage);

        $requestModel = new PhotoRequestModel();
        $requestModel->url = __DIR__ . '/../../ImportFileWithoutGallery.jpg';
        $requestModel->name = 'photoName';

        $interactor->setRequestModel($requestModel);
        $interactor->execute();
    }
}
