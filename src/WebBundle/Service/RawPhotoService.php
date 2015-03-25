<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Service;

use Freyr\Gallery\WebBundle\Entity\Image;
use Freyr\Gallery\WebBundle\Document\Photo;
use Freyr\Gallery\WebBundle\Storage\Cloudinary\CloudinaryPhotoStorage;
use Freyr\Gallery\WebBundle\Repository\MongoDB\MongoDBPhotoRepository;

/**
 * Class RawPhotoService
 * @package Freyr\GalleryCore\Service
 */
class RawPhotoService
{

    /**
     * @var MongoDBPhotoRepository
     */
    private $photoRepository;
    /**
     * @var CloudinaryPhotoStorage
     */
    private $photoStorage;

    /**
     * @param MongoDBPhotoRepository $photoRepository
     * @param CloudinaryPhotoStorage $photoStorage
     */
    public function __construct(MongoDBPhotoRepository $photoRepository, CloudinaryPhotoStorage $photoStorage)
    {
        $this->photoRepository = $photoRepository;
        $this->photoStorage = $photoStorage;
    }

    /**
     * @param Image $imageData
     * @return Photo
     */
    public function store(Image $imageData)
    {
        // store image
        $property = $this->photoStorage->storeRaw($imageData);

        return $this->photoRepository->persist($imageData, $property);
    }
}