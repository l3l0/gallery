<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Service;

use Freyr\GalleryBundle\Document\Gallery;
use Freyr\GalleryBundle\Document\GalleryCollection;
use Freyr\GalleryBundle\Document\Photo;
use Freyr\GalleryBundle\Document\PhotoCollection;
use Freyr\GalleryBundle\Document\Tag;
use Freyr\GalleryBundle\Document\TagCollection;
use Freyr\GalleryBundle\Repository\MongoDBPhotoRepository;

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
        $galleries = $this->photoRepository->getAllGalleries();
        foreach ($galleries as $gallery)
        {
            $this->photoRepository->assignPrimaryPhotoToGallery($gallery, 3);
        }

        return $galleries;
    }

    /**
     * @return TagCollection
     */
    public function getTagsListWithPrimaryPhoto()
    {
        $tags = $this->photoRepository->getAllTags();
        foreach ($tags as $tag)
        {
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
        foreach($cursor as $photo)
        {
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
        foreach($cursor as $photo)
        {
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
        return $this->photoRepository->getPhotoByTagAndId($tag, $id);
    }

    /**
     * @param Gallery $gallery
     * @param $id
     * @return Photo
     */
    public function getPhotoByIdAndGallery(Gallery $gallery, $id)
    {
        return $this->photoRepository->getPhotoFromGalleryAndById($gallery, $id);
    }
}
