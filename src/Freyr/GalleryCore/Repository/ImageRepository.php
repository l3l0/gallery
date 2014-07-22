<?php
namespace Freyr\GalleryCore\Repository;

use Freyr\GalleryCore\Entity\Gallery;
use Freyr\GalleryCore\Entity\Image;
use Freyr\GalleryCore\Entity\Keyword;

/**
 * Generic interface that should be implemented by custom data-source class that handle image management.
 * Interface MongoDBImageRepository
 * @package Freyr\GalleryCore\Repository
 */
interface ImageRepository {

    /**
     * @param Keyword $keyword
     * @param string $imageId
     * @return Image
     */
    public function getImageByKeywordAndId(Keyword $keyword, $imageId);

    /**
     * @return Keyword[]
     */
    public function getAllUniqueKeywords();

    /**
     * @param Keyword[] $keywords
     * @return Image[]
     */
    public function getImagesByKeywords(array $keywords);

    /**
     * @param Gallery $gallery
     * @return Image[]
     */
    public function getImagesByGallery(Gallery $gallery);

    /**
     * @param Image $image
     */
    public function save(Image $image);

    /**
     * @param Keyword $keyword
     * @param int $randomizedSampleSize
     * @return Image
     */
    public function getRandomImageByKeyword(Keyword $keyword, $randomizedSampleSize);

    /**
     * @param Gallery $gallery
     * @param int $randomizedSampleSize
     * @return Image
     */
    public function getRandomImageByCategory(Gallery $gallery, $randomizedSampleSize);

    /**
     * @return Gallery[]
     */
    public function getAllUniqueCategories();
}
