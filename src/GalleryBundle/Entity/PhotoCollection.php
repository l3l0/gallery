<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\GalleryBundle\Entity;

use Freyr\Gallery\GalleryBundle\Document\Photo;

/**
 * Class PhotoCollection
 * @package Freyr\Gallery\GalleryBundle\Document
 */
class PhotoCollection
{

    /**
     * @var Photo[]
     */
    private $photos = [];

    /**
     * @param $photo
     */
    public function addPhoto(Photo $photo)
    {
        $this->photos[$photo->getName()] = $photo;
    }

    /**
     * @return Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param Photo[] $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }
}
