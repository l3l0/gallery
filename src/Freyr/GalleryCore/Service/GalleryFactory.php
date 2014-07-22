<?php
namespace Freyr\GalleryCore\Service;

use Freyr\GalleryCore\Entity\Gallery;

/**
 * Class GalleryFactory
 * @package Freyr\GalleryBundle\Service
 */
class GalleryFactory {

    /**
     * @var string
     */
    private $galleryClass;

    /**
     * @param $galleryClass
     */
    public function __construct($galleryClass)
    {
        $this->galleryClass = $galleryClass;
    }

    /**
     * @param $galleryName
     * @return Gallery
     */
    public function create($galleryName)
    {
        return new $this->galleryClass($galleryName);
    }
}
