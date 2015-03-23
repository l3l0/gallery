<?php
namespace Freyr\Gallery\WebBundle\Repository;

use Doctrine\ODM\MongoDB\Cursor;
use Freyr\Gallery\WebBundle\Document\Gallery;
use Freyr\Gallery\WebBundle\Document\Tag;
use Freyr\Gallery\WebBundle\Document\Photo;

use Freyr\Gallery\WebBundle\Entity\GalleryCollection;
use Freyr\Gallery\WebBundle\Entity\Property;
use Freyr\Gallery\WebBundle\Entity\TagCollection;
use Freyr\Gallery\WebBundle\Entity\Image;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\Gallery\WebBundle\Repository
 */
interface PhotoRepositoryInterface
{

    /**
     * @param Image $image
     * @param Property $storagePropertyInterface
     * @return Photo
     */
    public function persist(Image $image, Property $storagePropertyInterface);

    /**
     * @return TagCollection
     */
    public function getTags();

    /**
     * @return GalleryCollection
     */
    public function getGalleries();

    /**
     * @param Gallery $gallery
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToGallery(Gallery $gallery, $randomizedSampleSize);

    /**
     * @param Tag $tag
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToTag(Tag $tag, $randomizedSampleSize);

    /**
     * @param string $imageId
     * @param Tag $tag
     * @return Photo
     */
    public function getPhotoByIdAndTag($imageId, Tag $tag);

    /**
     * @param string $imageId
     * @param Gallery $gallery
     * @return Photo
     */
    public function getPhotoByIdAndGallery($imageId, Gallery $gallery);

    /**
     * @param TagCollection $tags
     * @TODO: separate database sursor from interface
     * @return Cursor
     */
    public function getPhotosByTags(TagCollection $tags);

    /**
     * @param Gallery $gallery
     * @return Cursor
     */
    public function getPhotosFromGallery(Gallery $gallery);
}
