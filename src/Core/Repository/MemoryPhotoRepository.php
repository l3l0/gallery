<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Repository;

use Freyr\Gallery\Core\Entity\CoverPhoto;
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
     * @param Tag $tag
     * @return Photo
     */
    public function getRandomPhotoFromTag(Tag $tag)
    {
        return $this->photos[array_rand($this->photos)];
    }

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

        return $document;
    }

    /**
     * @param string $photoId
     * @return Photo
     */
    public function findById($photoId)
    {
        if (!array_key_exists($photoId, $this->photos)) {
            throw new \InvalidArgumentException();
        }
        $photo = $this->photos[$photoId];

        return $photo;
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
                $tag->setCoverPhoto(new CoverPhoto($photo));
                $tags[$tag->getName()] = $tag;
            }
        }

        return $tags;
    }


    /**
     * @param array $tags
     * @return Photo[]
     */
    public function findPhotosByTags(array $tags)
    {
        $tagNames = [];
        $photos = [];
        foreach ($tags as $tag) {
            $tagNames[] = $tag;
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
