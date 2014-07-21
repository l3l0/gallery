<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryCore\Service;

use Freyr\GalleryCore\Entity\Image;
use Freyr\GalleryCore\Entity\Keyword;
use Freyr\GalleryCore\Repository\ImageRepository;

/**
 * Class ImageService
 * @package Freyr\GalleryBundle\Service
 */
class ImageService {

    /**
     * @var MongoDBImageRepository
     */
    private $imageRepository;
    /**
     * @var KeywordFactory
     */
    private $keywordFactory;

    /**
     * @param ImageRepository $imageRepository
     * @param KeywordFactory $keywordFactory
     */
    public function __construct(ImageRepository $imageRepository, KeywordFactory $keywordFactory)
    {
        $this->imageRepository = $imageRepository;
        $this->keywordFactory = $keywordFactory;
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
     * @param string $keyword - one keyword or lists of keywords separated by comma.
     * @return Image[]
     */
    public function getImagesByKeywords($keyword)
    {
        if (strpos($keyword, ',') != false)
        {
            $keywords = explode(',', $keyword);
            foreach ($keywords as $key => $keyword)
            {
                $keywords[$key] = $this->keywordFactory->create($keyword);
            }
        }
        else
        {
            $keywords = [$this->keywordFactory->create($keyword)];
        }

        return $this->imageRepository->getImagesByKeywords($keywords);
    }

    /**
     * @param Keyword $keyword
     * @param $imageId
     * @return Image
     */
    public function getImageByKeywordAndId(Keyword $keyword, $imageId)
    {
        return $this->imageRepository->getImageByKeywordAndId($keyword, $imageId);
    }

    /**
     * @return Keyword[]
     * TODO: This should be category object, not reuse keyword, also refactory this and AllKeyword method... code duplicate smell
     */
    public function getAllCategories()
    {
        $result = $this->imageRepository->getAllUniqueCategories();
        $keywords = [];
        foreach ($result as $name)
        {
            $keyword = $this->keywordFactory->create($name);
            $image = $this->imageRepository->getRandomImageByCategory($keyword, 10);
            $image->setCurrentKeyword([$keyword]);
            $keyword->setPrimaryImage($image);

            $keywords[] = $keyword;
        }

        return $keywords;
    }
}
