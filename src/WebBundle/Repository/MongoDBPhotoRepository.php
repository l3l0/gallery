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
use Freyr\Gallery\WebBundle\Document\Photo as PhotoDocument;
use Freyr\Gallery\WebBundle\Document\Tag as TagDocument;

/**
 * Class MongoDBPhotoRepository
 * @package Freyr\Gallery\WebBundle\Repository
 */
class MongoDBPhotoRepository extends DocumentRepository implements PhotoRepositoryInterface
{

    /**
     * @param \Doctrine\ODM\MongoDB\DocumentManager $dm
     * @param \Doctrine\ODM\MongoDB\UnitOfWork $uow
     * @param \Doctrine\ODM\MongoDB\Mapping\ClassMetadata $classMetadata
     */
    public function __construct($dm, $uow, $classMetadata)
    {
        parent::__construct($dm, $uow, $classMetadata);
        $this->builder = new EntityBuilderHelper();

    }

    /**
     * @param Photo $photo
     * @return Photo
     */
    public function store(Photo $photo)
    {
        $document = new PhotoDocument();
        $document->setName($photo->getName());
        $document->setCloudId($photo->getCloudId());
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
        $photo = $this->findOneBy(["id" => new \MongoId($photoId)]);
        return $this->builder->buildPhotoEntity($photo);
    }

    /**
     * @return Gallery[]
     */
    public function findAllGalleries()
    {
        $result = [];
        /** @var Cursor $cursor */
        $cursor = $this->createQueryBuilder()->distinct('gallery.name')->getQuery()->execute();

        foreach ($cursor as $gallery) {
            $entity = $this->builder->buildGalleryEntity($gallery);
            $photos = $this->findBy(['gallery.name' => $entity->getName()], ["limit" => 3]);
            $coverPhoto = $this->builder->buildPhotoEntity($photos[array_rand($photos)]);
            $entity->setCoverPhoto($coverPhoto);
            $result[] = $entity;
        }

        return $result;
    }

    /**
     * @return Tag[]
     */
    public function findAllTags()
    {
        $result = [];

        /** @var Cursor $tags */
        $cursor = $this->createQueryBuilder()->distinct('tags.name')->getQuery()->execute();

        foreach ($cursor as $tag) {
            $entity = $this->builder->buildTagEntity($tag);
            $photos = $this->findBy(['tags.name' => $entity->getName()], ["limit" => 3]);
            $coverPhoto = $this->builder->buildPhotoEntity($photos[array_rand($photos)]);
            $entity->setCoverPhoto($coverPhoto);
            $result[] = $entity;
        }

        return $result;
    }


    /**
     * @param string $name
     * @return Photo[]
     */
    public function findPhotosFromGallery($name)
    {
        $result = [];

        $cursor = $this->createQueryBuilder()
            ->field('gallery.name')->equals($name)
            ->getQuery()->execute();

        foreach ($cursor as $photo) {
            $entity = $this->builder->buildPhotoEntity($photo);
            $result[] = $entity;
        }

        return $result;
    }

    /**
     * @param Tag[] $tags
     * @return Photo[]
     */
    public function findPhotosByTags(array $tags)
    {
        $result = [];

        $cursor = $this->createQueryBuilder()
            ->field('gallery.name')
            ->in($tags)
            ->getQuery()->execute();

        foreach ($cursor as $photo) {
            $entity = $this->builder->buildPhotoEntity($photo);
            $result[] = $entity;
        }

        return $result;
    }
}
