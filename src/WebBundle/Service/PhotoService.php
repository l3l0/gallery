<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Service;

use Freyr\Gallery\WebBundle\Document\Gallery;
use Freyr\Gallery\WebBundle\Entity\GalleryCollection;
use Freyr\Gallery\WebBundle\Document\Photo;
use Freyr\Gallery\WebBundle\Entity\PhotoCollection;
use Freyr\Gallery\WebBundle\Document\Tag;
use Freyr\Gallery\WebBundle\Entity\TagCollection;
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
     * @return GalleryCollection
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
     * @return TagCollection
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
     * @param Gallery $gallery
     * @return PhotoCollection
     */
    public function getPhotosFromGallery(Gallery $gallery)
    {
        $cursor = $this->photoRepository->getPhotosFromGallery($gallery);

        $photos = new PhotoCollection();

        /** @var Photo $photo */
        foreach ($cursor as $photo) {
            $photos->addPhoto($photo);
        }

        return $photos;
    }

    /**
     * @param TagCollection $tags
     * @return PhotoCollection
     */
    public function getPhotosByTags(TagCollection $tags)
    {
        $cursor = $this->photoRepository->getPhotosByTags($tags);

        $photos = new PhotoCollection();

        /** @var Photo $photo */
        foreach ($cursor as $photo) {
            $photos->addPhoto($photo);
        }

        return $photos;
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
     * @param Gallery $gallery
     * @param $id
     * @return Photo
     */
    public function getPhotoByIdAndGallery(Gallery $gallery, $id)
    {
        return $this->photoRepository->getPhotoByIdAndGallery($id, $gallery);
    }
}
