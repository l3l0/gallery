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
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
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
        $tags = [];
        foreach ($photo->getTags() as $tag) {
            $tags[] = new TagDocument($tag->getName());
        }
        $document->setTags($tags);
        $document->setThumbnails($photo->getThumbnails());

        $this->getDocumentManager()->persist($document);
        $this->getDocumentManager()->flush();

        $photo->setId((string) $document->getId());

        return $photo;
    }

    /**
     * @param string $photoId
     * @return Photo
     */
    public function findById($photoId)
    {
        /** @var PhotoDocument $photo */
        $photo = $this->findOneBy(["id" => new \MongoId($photoId)]);
        if ($photo === null) {
            throw new \InvalidArgumentException();
        }

        return $this->builder->buildPhotoEntity($photo);
    }

    /**
     * @return Tag[]
     */
    public function findAllTags()
    {
        $result = [];
        $cursor = $this->createQueryBuilder()->distinct('tags.name')->getQuery()->execute();

        foreach ($cursor as $tag) {
            /** @var Tag $tag */
            $tag = new Tag($tag);
            $result[] = $tag;
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
            ->field('tags.name')
            ->in($tags)
            ->getQuery()->execute();

        foreach ($cursor as $photo) {
            $result[] = $this->builder->buildPhotoEntity($photo);
        }

        return $result;
    }

    /**
     * @param Tag $tag
     * @return Photo
     */
    public function getRandomPhotoFromTag(Tag $tag)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['tag.name' => $tag->getName()], null, 10);

        return $this->builder->buildPhotoEntity($images[array_rand($images)]);
    }
}
