<?php
namespace Freyr\GalleryCore\Repository;

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
     * @param Image $image
     */
    public function save(Image $image);

    /**
     * @param Keyword $keyword
     * @param int $randomizedSampleSize
     * @return Image
     */
    public function getRandomImageByKeyword(Keyword $keyword, $randomizedSampleSize);
}