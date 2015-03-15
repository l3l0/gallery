<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Repository;

use Cloudinary\Uploader;
use Freyr\GalleryBundle\Document\Property;
use Freyr\GalleryBundle\Entity\ImageData;

/**
 * Class CloudinaryPhotoStorage
 * @package Freyr\GalleryBundle\Repository
 */
class CloudinaryPhotoStorage {

    /**
     * @param ImageData $image
     * @return Property
     */
    public function storeRaw(ImageData $image)
    {
        $response = Uploader::upload($image->getImageForStorage());
        return new Property($response);
    }
}
