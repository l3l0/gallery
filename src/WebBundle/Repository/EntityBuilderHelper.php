<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Repository;

use Freyr\Gallery\WebBundle\Document\Gallery;
use Freyr\Gallery\WebBundle\Document\Photo;
use Freyr\Gallery\WebBundle\Document\Tag;

/**
 * Class EntityBuilderHelper
 * @package Freyr\Gallery\WebBundle\Repository
 * TODO: rethink the idea...
 */
class EntityBuilderHelper
{

    /**
     * @param Photo $photo
     * @return \Freyr\Gallery\Core\Entity\Photo
     */
    public function buildPhotoEntity(Photo $photo)
    {
        $data = [
            'id' => $photo->getId(),
            'cloudId' => $photo->getCloudId(),
            'name' => $photo->getName(),
            'tags' => $this->buildTagData($photo->getTags()),
            'gallery' => $this->buildGalleryData($photo->getGallery()),
            'url' => $photo->getCloudId()
        ];

        return new \Freyr\Gallery\Core\Entity\Photo($data);
    }

    /**
     * @param Tag[] $tags
     * @return array
     */
    private function buildTagData($tags)
    {
        $data = [];
        foreach ($tags as $tag) {
            $data[] = ['name' => $tag->getName()];
        }

        return $data;
    }

    /**
     * @param Gallery $gallery
     * @return array
     */
    private function buildGalleryData(Gallery $gallery)
    {
        return ['name' => $gallery->getName()];
    }

    /**
     * @param string $galleryName
     * @return \Freyr\Gallery\Core\Entity\Gallery
     */
    public function buildGalleryEntity($galleryName)
    {
        $data = [
            'name' => $galleryName
        ];

        $entity = new \Freyr\Gallery\Core\Entity\Gallery($data);

        return $entity;
    }

    /**
     * @param string $tagName
     * @return \Freyr\Gallery\Core\Entity\Tag
     */
    public function buildTagEntity($tagName)
    {
        $data = [
            'name' => $tagName
        ];

        $entity = new \Freyr\Gallery\Core\Entity\Tag($data);

        return $entity;

    }
}