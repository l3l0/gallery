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
        ];

        //@TODO add real image base 64 (small 10x10px)
        return [
            'name' => 'photoname',
            'url' => 'somebase64image',
            'tags' => $tags,
            'gallery' => ['name' => 'GalleryName']
        ];
    }

    /**
     * @param Photo $photo
     */
    protected function addPhotoToRepository(Photo $photo)
    {
        $this->repository->store($photo);
    }

    /**
     * @param int $howManyPhotos
     * @param array $galleryNames
     * @param array $tagNames
     */
    protected function loadFixture($howManyPhotos, array $galleryNames, array $tagNames)
    {
        $tags = [];
        for ($i = 1; $i <= $howManyPhotos; $i++) {
            shuffle($tagNames);
            $randomTags = array_slice($tagNames, 0, rand(1, count($tagNames)));
            $galleryName = $galleryNames[rand(0, count($galleryNames) - 1)];
            foreach ($randomTags as $tagName) {
                $tags[] = ['name' => $tagName];
            }

            $data = [
                'name' => uniqid('PhotoName-'),
                'url' => uniqid('url-'),
                'tags' => $tags,
                'gallery' => ['name' => $galleryName]
            ];
            $photo = new Photo($data);
            $this->repository->store($photo);
        }
    }

    /**
     * @return array
     */
    protected function generateRandomPhotoData()
    {
        $tags = [
            ['name' => '   tag'],
            ['name' => 'tag '],
            ['name' => ' tag   '],
            ['name' => 'tag']
        ];

        $data = [
            'name' => uniqid('name'),
            'url' => uniqid('url'),
            'tags' => $tags,
            'gallery' => ['name' => ' Gallery1  ']
        ];

        return $data;
    }

    /**
     * @return array
     */
    protected function generateBase64PhotoData()
    {
        $uniq = uniqid();

        $data['name'] = 'photoname' . $uniq;
        $data['base64'] = 'someBase64EncodedString';
        $data['lightroomTags'] = ['tag' . $uniq, 'tag2' . $uniq, 'tag3' . $uniq, 'Gallery: Gallery One'];
        $data['mime'] = 'image/jpg';

        return $data;
    }
}
