<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Repository;

use Freyr\Gallery\Core\Entity\CoverPhoto;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;
use Freyr\Gallery\WebBundle\Document\Photo as PhotoDocument;
use Freyr\Gallery\WebBundle\Document\Tag as TagDocument;

/**
 * Class EntityBuilderHelper
 * @package Freyr\Gallery\WebBundle\Repository
 */
class EntityBuilderHelper
{

    /**
     * @param PhotoDocument $photoDocument
     * @return CoverPhoto
     */
    public function buildCoverPhoto(PhotoDocument $photoDocument)
    {
        $photo = $this->buildPhotoEntity($photoDocument);
        return new CoverPhoto($photo);
    }

    /**
     * @param PhotoDocument $photoDocument
     * @return Photo
     */
    public function buildPhotoEntity(PhotoDocument $photoDocument)
    {
        $photo = new Photo();
        $photo->setThumbnails($photoDocument->getThumbnails());
        $photo->setId($photoDocument->getId());
        $photo->setTags($this->buildTagData($photoDocument->getTags()));

        return $photo;
    }

    /**
     * @param TagDocument[] $tags
     * @return array
     */
    private function buildTagData($tags)
    {
        $data = [];
        foreach ($tags as $tag) {
            $data[] = $tag->getName();
        }

        return $data;
    }

    /**
     * @param TagDocument $tag
     * @return Tag
     */
    public function buildTagEntity(TagDocument $tag)
    {
        $entity = new Tag($tag->getName());

        return $entity;
    }
}
