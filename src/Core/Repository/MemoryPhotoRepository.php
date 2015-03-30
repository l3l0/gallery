<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Repository;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;

/**
 * Class MemoryPhotoRepository
 * @package Freyr\Gallery\Core\Repository
 */
class MemoryPhotoRepository implements PhotoRepositoryInterface
{

    /**
     * @var Photo[]
     */
    private $photos = [];

    /**
     * @param Photo $document
     * @return Photo
     */
    public function store(Photo $document)
    {
        if ($document->getId() === null) {
            $id = uniqid();
            $document->setId($id);
        }
        $this->photos[$document->getId()] = $document;
    }

    /**
     * @param string $photoId
     * @return Photo
     * @throws \Exception
     */
    public function findById($photoId)
    {
        $photo = $this->photos[$photoId];
        if (!$photo instanceof Photo) {
            // TODO: add exception
            throw new \Exception();
        }

        return $photo;

    }

    /**
     * @return Gallery[]
     */
    public function findAllGalleries()
    {
        $galleries = [];
        foreach ($this->photos as $photo) {
            $gallery = $photo->getGallery();
            $gallery->setCoverPhoto($photo);
            $galleries[$photo->getGallery()->getName()] = $gallery;
        }

        return $galleries;
    }

    /**
     * @return Tag[]
     */
    public function findAllTags()
    {
        $tags = [];
        foreach ($this->photos as $photo) {
            $photoTags = $photo->getTags();
            foreach ($photoTags as $tag) {
                $tag->setCoverPhoto($photo);
                $tags[$tag->getName()] = $tag;
            }
        }

        return $tags;
    }


    /**
     * @param string $name
     * @return Photo[]
     */
    public function findPhotosFromGallery($name)
    {
        $photos = [];
        foreach ($this->photos as $photo) {
            if ($photo->getGallery()->getName() === $name) {
                $photos[] = $photo;
            }
        }

        return $photos;
    }

    /**
     * @param Tag[] $tags
     * @return Photo[]
     */
    public function findPhotosByTags(array $tags)
    {
        $tagNames = [];
        $photos = [];
        foreach ($tags as $tag) {
            $tagNames[] = $tag->getName();
        }

        foreach ($this->photos as $photo) {
            $photoTagNames = [];
            foreach ($photo->getTags() as $tag) {
                $photoTagNames[] = $tag->getName();
            }

            $match = array_intersect($photoTagNames, $tagNames);

            if (count($match) > 0) {
                $photos[] = $photo;
            }
        }

        return $photos;
    }


}
