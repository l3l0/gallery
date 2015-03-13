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
use Freyr\GalleryBundle\Document\LightroomImage;
use Freyr\GalleryBundle\Document\Property;

/**
 * Class CloudinaryPhotoStorage
 * @package Freyr\GalleryBundle\Repository
 */
class CloudinaryPhotoStorage {

    /**
     * @param LightroomImage $image
     * @return Property
     */
    public function storeRaw(LightroomImage $image)
    {
        $response = Uploader::upload('data:image/png;base64,' . $image->getRawImageContent());
        return new Property($response);
    }
}
