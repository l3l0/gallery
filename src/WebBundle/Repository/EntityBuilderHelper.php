<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-30
 * Time: 10:23
 */

namespace Freyr\Gallery\WebBundle\Repository;

use Freyr\Gallery\WebBundle\Document\Gallery;
use Freyr\Gallery\WebBundle\Document\Photo;
use Freyr\Gallery\WebBundle\Document\Tag;

/**
 * Class EntityBuilderHelper
 * @package Freyr\Gallery\WebBundle\Repository
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
            'gallery' => $this->buildGalleryData($photo->getGallery())
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
     * @param Gallery $gallery
     * @return \Freyr\Gallery\Core\Entity\Gallery
     */
    public function buildGalleryEntity(Gallery $gallery)
    {
        $data = [
            'name' => $gallery->getName()
        ];

        $entity = new \Freyr\Gallery\Core\Entity\Gallery($data);

        return $entity;
    }

    /**
     * @param Tag $tag
     * @return \Freyr\Gallery\Core\Entity\Tag
     */
    public function buildTagEntity(Tag $tag)
    {
        $data = [
            'name' => $tag->getName()
        ];

        $entity = new \Freyr\Gallery\Core\Entity\Tag($data);

        return $entity;
    }
}
