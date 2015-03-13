<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Service;

use Freyr\GalleryBundle\Document\LightroomImage;
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
     * @param $rawData
     * @return Photo
     */
    public function store($rawData)
    {
        // create image from data
        $rawImage = $this->createImageFromRawData($rawData);

        // store image
        $property = $this->photoStorage->storeRaw($rawImage);
        return $this->photoRepository->saveLightroomImage($rawImage, $property);
    }

    /**
     * @param $rawData
     * @return LightroomImage
     */
    public function createImageFromRawData($rawData)
    {
        $image = new LightroomImage();
        $image->setRawImageContent($rawData->image);
        $gallery = $this->fetchGalleryName($rawData->tags);
        $image->setGallery($gallery);
        $image->setTags($rawData->tags);

        return $image;
    }

    /**
     * @param $tags
     * @return string
     */
    private function fetchGalleryName($tags)
    {
        $galleryName = '';
        foreach ($tags as $key => $tag) {
            if (preg_match('/Gallery\:/', $tag)) {
                $galleryName = str_replace('Gallery: ', '', $tag);
                unset($tags[$key]);
                break;
            }
        }
        return $galleryName;
    }
}
