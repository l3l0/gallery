<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Repository;

use Doctrine\ODM\MongoDB\Cursor;
use Doctrine\ODM\MongoDB\DocumentRepository;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;

use Freyr\Gallery\WebBundle\Document\Gallery as GalleryDocument;
use Freyr\Gallery\WebBundle\Document\Tag as TagDocument;
use Freyr\Gallery\WebBundle\Document\Photo as PhotoDocument;

/**
 * Class MongoDBPhotoRepository
 * @package Freyr\Gallery\WebBundle\Repository
 */
class MongoDBPhotoRepository extends DocumentRepository implements PhotoRepositoryInterface
{
    /**
     * @param Photo $photo
     * @return Photo
     */
    public function store(Photo $photo)
    {
        $document = new PhotoDocument();
        $document->setName($photo->getName());
        $gallery = new GalleryDocument($photo->getGallery()->getName());
        $document->setGallery($gallery);
        $tags = [];
        foreach ($photo->getTags() as $tag) {
            $tags[] = new TagDocument($tag->getName());
        }
        $document->setTags($tags);

        $this->getDocumentManager()->persist($document);
        $this->getDocumentManager()->flush();

        $photo->setId((string)$document->getId());
        return $photo;
    }

    /**
     * @param string $photoId
     * @return Photo
     */
    public function findById($photoId)
    {
        // TODO: Add Photo Factory to transform ORM object into Core Entities
        return $this->findOneBy(["id" => new \MongoId($photoId)]);
    }

    /**
     * @return Gallery[]
     */
    public function findAllGalleries()
    {
        // TODO: Add Factory to transform ORM cursor into Core Gallery Entities
        /** @var Cursor $cursor */
        $cursor = $this->createQueryBuilder()->distinct('gallery.name')->getQuery()->execute();

        // TODO: Assign primary photo to gallery
        /** @var Cursor $cursor */
        $images = $this->findBy(['gallery.name' => $gallery->getName()], ["limit" => $randomizedSampleSize]);
        $image = $images[array_rand($images)];
        $gallery->setPrimaryImage($image);
    }

    /**
     * @param string $name
     * @return Photo[]
     */
    public function findPhotosFromGallery($name)
    {
        $cursor = $this->createQueryBuilder()
            ->field('gallery.name')->equals($name)
            ->getQuery()->execute();

        // TODO: Core Photo Entity factory from ORM
    }

    /**
     * @param Tag[] $tags
     * @return Photo[]
     */
    public function findPhotosByTags(array $tags)
    {
        return $this->createQueryBuilder()
            ->field('gallery.name')
            ->in($tags)
            ->getQuery()->execute();

        // TODO: Core Photo Entity factory from ORM
    }

    ###########################################################################################


    /**
     * @return TagInterface[]
     */
    public function getTags()
    {
        /** @var Cursor $tags */
        $tags = $this->createQueryBuilder()->distinct('tags.name')->getQuery()->execute();
    }

    /**
     * @param TagInterface $tag
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToTag(TagInterface $tag, $randomizedSampleSize)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['tag.name' => $tag->getName()], ["limit" => $randomizedSampleSize]);
        $image = $images[array_rand($images)];
        $tag->setPrimaryPhoto($image);
    }

}
