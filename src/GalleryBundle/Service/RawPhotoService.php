<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Service;

use Freyr\GalleryBundle\Entity\ImageData;
use Freyr\GalleryBundle\Document\Photo;
use Freyr\GalleryBundle\Repository\CloudinaryPhotoStorage;
use Freyr\GalleryBundle\Repository\MongoDBPhotoRepository;

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
     * @param ImageData $imageData
     * @return Photo
     */
    public function store(ImageData $imageData)
    {
        // store image
        $property = $this->photoStorage->storeRaw($imageData);

        return $this->photoRepository->saveImage($imageData, $property);
    }
}
