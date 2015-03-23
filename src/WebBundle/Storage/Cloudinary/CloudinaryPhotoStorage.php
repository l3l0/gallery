<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Storage\Cloudinary;

use Cloudinary\Uploader;
use Freyr\Gallery\WebBundle\Entity\Property;
use Freyr\Gallery\WebBundle\Entity\Image;

/**
 * Class CloudinaryPhotoStorage
 * @package Freyr\Gallery\FreyrGalleryWebBundle\Storage\Cloudinary
 */
class CloudinaryPhotoStorage
{

    /**
     * @param Image $image
     * @return Property
     */
    public function storeRaw(Image $image)
    {
        $response = Uploader::upload($image->getImageForStorage());

        return new Property($response);
    }
}
