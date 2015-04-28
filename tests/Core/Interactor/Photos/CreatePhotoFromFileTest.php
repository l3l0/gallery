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
use Freyr\Gallery\Core\RequestModel\ImageRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CreatePhotoFromFileTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class CreatePhotoFromFileTest extends PhotoTestCase
{

    public function testCreateNewPhoto()
    {

        $requestModel = new ImageRequestModel();
        $requestModel->url = __DIR__ . '/../../ImportFileWithGallery.jpg';
        $requestModel->name = 'photoName';

        $interactor = new CreatePhotoFromFile($requestModel, $this->repository, $this->storage);
        $interactor->execute();
    }

    /**
     * @expectedException \Exception
     */
    public function testCreateNewPhotoFromFileWithoutGallery()
    {
        $requestModel = new ImageRequestModel();
        $requestModel->url = __DIR__ . '/../../ImportFileWithoutGallery.jpg';
        $requestModel->name = 'photoName';

        $interactor = new CreatePhotoFromFile($requestModel, $this->repository, $this->storage);
        $interactor->execute();
    }
}
