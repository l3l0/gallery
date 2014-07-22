<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryCore\Service;

use Freyr\GalleryCore\Entity\Gallery;
use Freyr\GalleryCore\Entity\Image;
use Freyr\GalleryCore\Entity\Keyword;
use Freyr\GalleryCore\Repository\ImageRepository;

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
     * @var KeywordFactory
     */
    private $keywordFactory;
    /**
     * @var GalleryFactory
     */
    private $galleryFactory;

    /**
     * @param ImageRepository $imageRepository
     * @param KeywordFactory $keywordFactory
     * @param GalleryFactory $galleryFactory
     */
    public function __construct(ImageRepository $imageRepository, KeywordFactory $keywordFactory, GalleryFactory $galleryFactory)
    {
        $this->imageRepository = $imageRepository;
        $this->keywordFactory = $keywordFactory;
        $this->galleryFactory = $galleryFactory;
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
            $keyword = $this->keywordFactory->create($name);
            $image = $this->imageRepository->getRandomImageByKeyword($keyword, 10);
            $image->setCurrentKeyword([$keyword]);
            $keyword->setPrimaryImage($image);

            $keywords[] = $keyword;
        }

        return $keywords;
    }

    /**
     * @param string $keywordsName - one keyword or lists of keywords separated by comma.
     * @return Image[]
     */
    public function getImagesByKeywords($keywordsName)
    {
        if (strpos($keywordsName, ',') != false)
        {
            $keywords = explode(',', $keywordsName);
            foreach ($keywords as $key => $keywordsName)
            {
                $keywords[$key] = $this->keywordFactory->create($keywordsName);
            }
        }
        else
        {
            $keywords = [$this->keywordFactory->create($keywordsName)];
        }

        return $this->imageRepository->getImagesByKeywords($keywords);
    }

    /**
     * @param $galleryName
     * @return Image[]
     */
    public function getImagesByGallery($galleryName)
    {
        $gallery = $this->galleryFactory->create($galleryName);
        return $this->imageRepository->getImagesByGallery($gallery);
    }

    /**
     * @param string $name
     * @param string $imageId
     * @return Image
     */
    public function getImageByKeywordAndId($name, $imageId)
    {
        $keyword = $this->keywordFactory->create($name);
        $result = $this->imageRepository->getImageByKeywordAndId($keyword, $imageId);
        if (empty($result))
        {
            $gallery = $this->galleryFactory->create($name);
            $result = $this->imageRepository->getImageByGalleryAndId($gallery, $imageId);
        }

        return $result;
    }

    /**
     * @return Gallery[]
     */
    public function getAllCategories()
    {
        $result = $this->imageRepository->getAllUniqueCategories();
        $galleries = [];
        foreach ($result as $name)
        {
            $gallery = $this->galleryFactory->create($name);
            $image = $this->imageRepository->getRandomImageByCategory($gallery, 10);
            $image->setCurrentKeyword([$gallery]);
            $gallery->setPrimaryImage($image);

            $galleries[] = $gallery;
        }

        return $galleries;
    }
}
