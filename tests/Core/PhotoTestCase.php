<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Repository\MemoryPhotoRepository;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\RequestModel;
use Freyr\Gallery\Core\Storage\MemoryPhotoStorage;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;
use Freyr\Gallery\Tests\BaseTestCase;

/**
 * Class PhotoTestCase
 * @package Freyr\Gallery\Tests\Core
 */
class PhotoTestCase extends BaseTestCase
{

    /**
     * @var PhotoRepositoryInterface
     */
    protected $repository;

    /**
     * @var PhotoStorageInterface
     */
    protected $storage;

    public function setUp()
    {
        $this->repository = new MemoryPhotoRepository();
        $this->storage = new MemoryPhotoStorage();
    }

    /**
     * @return array
     */
    public function prepareDataForNewPhoto()
    {
        $tags = [
            ['name' => '   tag'],
            ['name' => 'tag '],
            ['name' => ' tag   '],
            ['name' => 'tag'],
            ['name' => ' Gallery: Gallery1  ']
        ];

        //@TODO add real image base 64 (small 10x10px)
        return [
            'name' => 'photoname',
            'url' => 'somebase64image',
            'tags' => $tags
        ];
    }

    /**
     * TODO: consider refactor
     * @return Photo
     */
    protected function addRandomPhoto()
    {
        $tags = [
            ['name' => '   tag'],
            ['name' => 'tag '],
            ['name' => ' tag   '],
            ['name' => 'tag'],
            ['name' => ' Gallery: Gallery1  ']
        ];

        $data = [
            'name' => uniqid('name'),
            'url' => uniqid('url'),
            'tags' => $tags,
        ];

        $photo = new Photo($data);
        $this->repository->store($photo);
        return $photo;
    }

    /**
     * @return RequestModel
     */
    protected function generatePhotoRequestModel()
    {
        $uniq = uniqid();
        $tags = [
            ['name' => 'tag' . $uniq],
            ['name' => 'tag2' . $uniq],
            ['name' => 'tag3' . $uniq],
            ['name' => 'Gallery: Gallery' . $uniq]
        ];

        $requestModel = new RequestModel();
        $requestModel->name = 'photoname' . $uniq;
        $requestModel->imageContent = 'someBase64EncodedString';
        $requestModel->tags = $tags;

        return $requestModel;
    }
}
