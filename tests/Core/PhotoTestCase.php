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

    public function setUp()
    {
        $this->repository = new MemoryPhotoRepository();
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
     * @return Photo
     */
    protected function getSamplePhoto()
    {
        $photo = new Photo();
        $photo->setTags(['tag1  ', 'tag2', 'tag 3']);
        $photo->setId(4);
        $photo->setThumbnails([Photo::THUMBNAIL_STANDARD => 'standardUrl', Photo::THUMBNAIL_SMALL => 'smallUrl']);

        return $photo;
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
     * @param array $tagNames
     */
    protected function loadFixture($howManyPhotos, array $tagNames)
    {
        for ($i = 1; $i <= $howManyPhotos; $i++) {
            $thumbnails[Photo::THUMBNAIL_SMALL] = uniqid('small');
            $thumbnails[Photo::THUMBNAIL_STANDARD] = uniqid('standard');
            $photo = new Photo();
            $photo->setTags($tagNames);
            $photo->setThumbnails($thumbnails);
            $this->repository->store($photo);
        }
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
            ['name' => 'tag']
        ];

        $data = [
            'name' => uniqid('name'),
            'url' => uniqid('url'),
            'tags' => $tags,
            'gallery' => ['name' => ' Gallery: Gallery1  ']
        ];

        $photo = new Photo($data);
        $this->repository->store($photo);

        return $photo;
    }
}
