<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Repository;

use Doctrine\ODM\MongoDB\Cursor;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Freyr\GalleryCore\Entity\Gallery;
use Freyr\GalleryCore\Entity\Image;
use Freyr\GalleryCore\Entity\Keyword;
use Freyr\GalleryCore\Repository\ImageRepository;

/**
 * MongoDBImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MongoDBImageRepository extends DocumentRepository implements ImageRepository
{

    /**
     * @return Cursor
     */
    public function getAllUniqueKeywords()
    {
        return $this->createQueryBuilder()->distinct('keywords.name')->getQuery()->execute();
    }

    /**
     * @param Image $image
     * TODO: Refactor - flush at the end of process, not for every image separatelly.
     */
    public function save(Image $image)
    {
        $this->getDocumentManager()->persist($image);
        $this->getDocumentManager()->flush();
    }

    /**
     * @param Keyword $keyword
     * @param int $randomizedSampleSize
     * @return Image
     */
    public function getRandomImageByKeyword(Keyword $keyword, $randomizedSampleSize)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['keywords.name' => $keyword->getName()], ["limit" => $randomizedSampleSize]);
        return $images[array_rand($images)];
    }

    /**
     * @param Gallery $gallery
     * @param int $randomizedSampleSize
     * @return Image
     */
    public function getRandomImageByCategory(Gallery $gallery, $randomizedSampleSize)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['category.name' => $gallery->getName()], ["limit" => $randomizedSampleSize]);
        return $images[array_rand($images)];
    }

    /**
     * @param Keyword $keyword
     * @param string $imageId
     * @return Image
     */
    public function getImageByKeywordAndId(Keyword $keyword, $imageId)
    {
        return $this->findOneBy(["keywords.name" => $keyword->getName(), "id" => new \MongoId($imageId)]);
    }

    /**
     * @param Gallery $gallery
     * @param string $imageId
     * @return Image
     */
    public function getImageByGalleryAndId(Gallery $gallery, $imageId)
    {
        return $this->findOneBy(["category.name" => $gallery->getName(), "id" => new \MongoId($imageId)]);
    }

    /**
     * @param Keyword[] $keywords
     * @return Image[]
     */
    public function getImagesByKeywords(array $keywords)
    {
        $cursor = $this->createQueryBuilder()
            ->field('keywords.name')
            ->in($this->keywordsToArray($keywords))
            ->getQuery()->execute();

        $images = [];
        /** @var Image $image */
        foreach($cursor as $image)
        {

            $images[] = $image;
        }

        return $images;
    }

    /**
     * @param Gallery $gallery
     * @return Image[]
     * TODO: smell, overcomplicated - check gallery and keywords - maybe can be IS-A?
     */
    public function getImagesByGallery(Gallery $gallery)
    {
        $cursor = $this->createQueryBuilder()
            ->field('category.name')->equals($gallery->getName())
            ->getQuery()->execute();

        $images = [];
        /** @var Image $image */
        foreach($cursor as $image)
        {
            $image->setGalleryAsKeyword($gallery);
            $images[] = $image;
        }

        return $images;
    }

    /**
     * @return Cursor
     */
    public function getAllUniqueCategories()
    {
        return $this->createQueryBuilder()->distinct('category.name')->getQuery()->execute();
    }

    /**
     * @param Keyword[] $keywords
     * @return array
     */
    public function keywordsToArray($keywords)
    {
        $result = [];
        foreach ($keywords as $keyword)
        {
            $result[] = $keyword->getName();
        }

        return $result;
    }
}
