<?php
namespace Freyr\GalleryCore\Entity;

/**
 * Interface Keyword
 * @package Freyr\GalleryCore\Entity
 */
interface Gallery {

    /**
     * @param string $galleryName
     */
    public function __construct($galleryName);

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
