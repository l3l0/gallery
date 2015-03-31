<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Storage\Cloudinary;

use Cloudinary\Uploader;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CloudinaryPhotoStorage
 * @package Freyr\Gallery\WebBundle\Storage\Cloudinary
 */
class CloudinaryPhotoStorage implements PhotoStorageInterface
{
    /**
     * @param Photo $photo
     * @return Photo
     */
    public function store(Photo $photo)
    {
        $response = Uploader::upload($photo->getUrl());
        $photo->setCloudId($response['public_id']);
    }
}
