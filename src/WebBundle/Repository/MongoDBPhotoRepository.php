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
     * @param \Doctrine\ODM\MongoDB\DocumentManager $dm
     * @param \Doctrine\ODM\MongoDB\UnitOfWork $uow
     * @param \Doctrine\ODM\MongoDB\Mapping\ClassMetadata $classMetadata
     */
    public function __construct($dm, $uow, $classMetadata)
    {
        parent::__construct($dm, $uow, $classMetadata);
        // TODO: move outside to DI container
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
        $cursor = $this->createQueryBuilder()->distinct('gallery.name')->getQuery()->execute();

        foreach ($cursor as $gallery) {
            $entity = $this->builder->buildGalleryEntity($gallery);
            $primaryPhotoDocuments = $this->findBy(['gallery.name' => $entity->getName()], ["limit" => 3]);
            $primaryPhotoDocument = $primaryPhotoDocuments[array_rand($primaryPhotoDocuments)];
            $coverPhoto = $this->builder->buildPhotoEntity($primaryPhotoDocument);
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
        /** @var Tag[] $cursor */
        $cursor = $this->createQueryBuilder()->distinct('tags.name')->getQuery()->execute();

        foreach ($cursor as $tag) {
            $tagEntity = $this->builder->buildTagEntity($tag);
            $photos = $this->findBy(['tag.name' => $tag->getName()], ["limit" => 3]);
            $photo = $photos[array_rand($photos)];
            $coverPhoto = $this->builder->buildPhotoEntity($photo);
            $tagEntity->setCoverPhoto($coverPhoto);
            $result[] = $tag;
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
     * @param array $tags
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
            $result[] = $this->builder->buildPhotoEntity($photo);
        }

        return $result;
    }

    /**
     * @param Gallery $gallery
     * @return Photo
     */
    public function getRandomPhotoFromGallery(Gallery $gallery)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['gallery.name' => $gallery->getName()], ["limit" => 10]);

        return $images[array_rand($images)];
    }

    /**
     * @param Tag $tag
     * @return Photo
     */
    public function getRandomPhotoFromTag(Tag $tag)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['tag.name' => $tag->getName()], ["limit" => 10]);

        return $images[array_rand($images)];
    }

    /**
     * @param string $gallenyName
     * @return Gallery
     */
    public function getGalleryByName($gallenyName)
    {

    }


}
