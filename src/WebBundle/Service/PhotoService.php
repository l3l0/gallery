<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Service;

use Freyr\Gallery\Core\GalleryInterface;
use Freyr\Gallery\Core\PhotoFactory;
use Freyr\Gallery\Core\PhotoInterface;
use Freyr\Gallery\Core\TagInterface;
use Freyr\Gallery\WebBundle\Document\Photo;
use Freyr\Gallery\WebBundle\Document\Tag;
use Freyr\Gallery\WebBundle\Repository\MongoDB\MongoDBPhotoRepository;

/**
 * Class PhotoService
 * @package Freyr\GalleryCore\Service
 */
class PhotoService
{

    /**
     * @var MongoDBPhotoRepository
     */
    private $photoRepository;

    /**
     * @param MongoDBPhotoRepository $photoRepository
     */
    public function __construct(MongoDBPhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    /**
     * @return GalleryInterface[]
     */
    public function getGalleryListWithPrimaryPhoto()
    {
        $galleries = $this->photoRepository->getGalleries();
        foreach ($galleries as $gallery) {
            $this->photoRepository->assignPrimaryPhotoToGallery($gallery, 3);
        }

        return $galleries;
    }

    /**
     * @return TagInterface[]
     */
    public function getTagsListWithPrimaryPhoto()
    {
        $tags = $this->photoRepository->getTags();
        foreach ($tags as $tag) {
            $this->photoRepository->assignPrimaryPhotoToTag($tag, 3);
        }

        return $tags;
    }

    /**
     * @param GalleryInterface $gallery
     * @return PhotoInterface[]
     */
    public function getPhotosFromGallery(GalleryInterface $gallery)
    {
        return $this->photoRepository->getPhotosFromGallery($gallery);
    }

    /**
     * @param TagInterface[] $tags
     * @return PhotoInterface[]
     */
    public function getPhotosByTags(array $tags)
    {
        $cursor = $this->photoRepository->getPhotosByTags($tags);

        return PhotoFactory::createMultiplePhotos($cursor, 'Freyr\Gallery\WebBundle\Document\Photo');
    }

    /**
     * @param Tag $tag
     * @param $id
     * @return Photo
     */
    public function getPhotoByIdAndTag(Tag $tag, $id)
    {
        return $this->photoRepository->getPhotoByIdAndTag($id, $tag);
    }

    /**
     * @param GalleryInterface $gallery
     * @param $id
     * @return Photo
     */
    public function getPhotoByIdAndGallery(GalleryInterface $gallery, $id)
    {
        return $this->photoRepository->getPhotoByIdAndGallery($id, $gallery);
    }
}
