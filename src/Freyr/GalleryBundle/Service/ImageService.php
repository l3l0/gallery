<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Service;

use Freyr\GalleryBundle\Document\Image;
use Freyr\GalleryBundle\Document\Keyword;
use Freyr\GalleryBundle\Repository\ImageRepository;

/**
 * Class ImageService
 * @package Freyr\GalleryBundle\Service
 */
class ImageService {

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywordsList()
    {
        $result = $this->imageRepository->getAllUniqueKeywords();
        $keywords = [];
        foreach ($result as $name)
        {
            $keyword = new Keyword($name);
            $image = $this->getRandomImageForKeyword($keyword);
            $keyword->setPrimaryImage($image);

            $keywords[] = $keyword;
        }

        return $keywords;
    }

    /**
     * @param Keyword $keyword
     * @return Image
     */
    public function getRandomImageForKeyword(Keyword $keyword)
    {
        $image = $this->imageRepository->getRandomImageByKeyword($keyword->getName(), 10);
        return $this->setImageMetaData($keyword, $image);
    }

    /**
     * @param $keyword
     * @param $image
     * @return mixed
     */
    private function setImageMetaData($keyword, Image $image)
    {
        $image->setCurrentKeyword([$keyword]);
        $image->setThumbImageUrl(cloudinary_url($image->getCloudinaryId(), ['width' => '250']));
        $image->setImageUrl(cloudinary_url($image->getCloudinaryId(), ['width' => '650']));
        $image->setBigImageUrl(cloudinary_url($image->getCloudinaryId(), ['width' => '950']));
        return $image;
    }
} 
