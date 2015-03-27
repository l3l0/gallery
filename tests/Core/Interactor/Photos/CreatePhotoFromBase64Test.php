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
use Freyr\Gallery\Core\RequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class CreatePhotoFromBase64Test
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class CreatePhotoFromBase64Test extends PhotoTestCase
{

    public function testCreateNewPhoto()
    {
        $requestModel = new RequestModel();
        $requestModel->imageContent = 'somebase64encodedstring';
        $requestModel->name = 'photoName';
        $requestModel->tags = [
            ['name' => 'tag1'],
            ['name' => 'tag2',],
            ['name' => 'tag4'],
            ['name' => '  tag5'],
            ['name' => '   5jhs8  '],
            ['name' => '  kjdhs ksjh jdh   '],
            ['name' => 'Gallery: gallery1   '],
        ];
        $interactor = new CreatePhotoFromBase64($this->repository, $this->storage);
        $interactor->setRequestModel($requestModel);

        $interactor->execute();
    }

    /**
     * @expectedException \Exception
     */
    public function testValidationEmptyGallery()
    {
        $requestModel = new RequestModel();
        $requestModel->imageContent = 'somebase64encodedstring';
        $requestModel->name = 'photoName';
        $requestModel->tags = [
            ['name' => 'tag1'],
            ['name' => 'tag2',],
            ['name' => 'tag4'],
            ['name' => '  tag5'],
            ['name' => '   5jhs8  '],
            ['name' => '  kjdhs ksjh jdh   ']
        ];

        $interactor = new CreatePhotoFromBase64($this->repository, $this->storage);
        $interactor->setRequestModel($requestModel);
        $interactor->execute();
    }
}
