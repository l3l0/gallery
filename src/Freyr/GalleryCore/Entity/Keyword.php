<?php
namespace Freyr\GalleryCore\Entity;

/**
 * Interface Keyword
 * @package Freyr\GalleryCore\Entity
 */
interface Keyword {

    /**
     * @param string $keywordName
     */
    public function __construct($keywordName);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return Image
     */
    public function getPrimaryImage();

    /**
     * @param Image $primaryImage
     */
    public function setPrimaryImage(Image $primaryImage);
}