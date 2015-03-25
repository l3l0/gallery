<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core;

use Freyr\Gallery\Core\Repository\MemoryPhotoRepository;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
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
            ['name' => 'tag']
        ];

        $gallery = [
            'name' => ' gallery1  '
        ];

        //@TODO add real image base 64 (small 10x10px)
        return [
            'name' => 'photoname',
            'url' => 'somebase64image',
            'tags' => $tags,
            'gallery' => $gallery
        ];
    }
}
