<?php
namespace Freyr\Gallery\WebBundle\Repository;

use Doctrine\ODM\MongoDB\Cursor;
use Freyr\Gallery\Core\GalleryInterface;
use Freyr\Gallery\Core\PhotoInterface;
use Freyr\Gallery\Core\TagInterface;
use Freyr\Gallery\WebBundle\Document\Gallery;
use Freyr\Gallery\WebBundle\Document\Tag;
use Freyr\Gallery\WebBundle\Document\Photo;

use Freyr\Gallery\WebBundle\Document\Property;
use Freyr\Gallery\Core\Entity\Image;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\Gallery\WebBundle\Repository
 */
interface PhotoRepositoryInterface
{

    /**
     * @param Image $image
     * @param Property $storagePropertyInterface
     * @return PhotoInterface
     */
    public function persist(Image $image, Property $storagePropertyInterface);

    /**
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * @return GalleryInterface[]
     */
    public function getGalleries();

    /**
     * @param GalleryInterface $gallery
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToGallery(GalleryInterface $gallery, $randomizedSampleSize);

    /**
     * @param TagInterface $tag
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToTag(TagInterface $tag, $randomizedSampleSize);

    /**
     * @param string $imageId
     * @param TagInterface $tag
     * @return Photo
     */
    public function getPhotoByIdAndTag($imageId, TagInterface $tag);

    /**
     * @param string $imageId
     * @param GalleryInterface $gallery
     * @return Photo
     */
    public function getPhotoByIdAndGallery($imageId, GalleryInterface $gallery);

    /**
     * @param TagInterface[] $tags
     * @return \Iterator
     */
    public function getPhotosByTags(array $tags);

    /**
     * @param GalleryInterface $gallery
     * @return Cursor
     */
    public function getPhotosFromGallery(GalleryInterface $gallery);
}
