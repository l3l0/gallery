<?php
namespace Freyr\Gallery\GalleryBundle\Repository;

use Doctrine\ODM\MongoDB\Cursor;
use Freyr\Gallery\GalleryBundle\Document\Gallery;
use Freyr\Gallery\GalleryBundle\Document\Tag;
use Freyr\Gallery\GalleryBundle\Document\Photo;

use Freyr\Gallery\GalleryBundle\Entity\GalleryCollection;
use Freyr\Gallery\GalleryBundle\Entity\Property;
use Freyr\Gallery\GalleryBundle\Entity\TagCollection;
use Freyr\Gallery\GalleryBundle\Entity\Image;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\Gallery\GalleryBundle\Repository
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
