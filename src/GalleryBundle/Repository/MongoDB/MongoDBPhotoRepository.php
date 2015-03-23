<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\GalleryBundle\Repository\MongoDB;

use Doctrine\ODM\MongoDB\Cursor;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Freyr\Gallery\GalleryBundle\Document\Gallery;
use Freyr\Gallery\GalleryBundle\Document\Tag;
use Freyr\Gallery\GalleryBundle\Document\Photo;

use Freyr\Gallery\GalleryBundle\Entity\TagCollection;
use Freyr\Gallery\GalleryBundle\Entity\Image;
use Freyr\Gallery\GalleryBundle\Entity\Property;
use Freyr\Gallery\GalleryBundle\Repository\PhotoRepositoryInterface;

/**
 * MongoDBPhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MongoDBPhotoRepository extends DocumentRepository implements PhotoRepositoryInterface
{

    /**
     * @param Image $image
     * @param Property $storagePropertyInterface
     * @return Photo
     */
    public function persist(Image $image, Property $storagePropertyInterface)
    {
        $photo = new Photo();
        $photo->setProperty($storagePropertyInterface);
        $photo->setName($storagePropertyInterface->getPublicId());
        $gallery = new Gallery($image->getGallery());
        $photo->setGallery($gallery);
        $tags = [];
        foreach ($image->getTags() as $tag) {
            $tags[] = new Tag($tag);
        }
        $photo->setTags($tags);

        $this->getDocumentManager()->persist($photo);
        $this->getDocumentManager()->flush();

        return $photo;
    }

    /**
     * @return TagCollection
     */
    public function getTags()
    {
        /** @var Cursor $tags */
        $tags = $this->createQueryBuilder()->distinct('tags.name')->getQuery()->execute();

        return new TagCollection($tags->toArray());
    }

    /**
     * @return GalleryCollection
     */
    public function getGalleries()
    {
        /** @var Cursor $galleries */
        $galleries = $this->createQueryBuilder()->distinct('gallery.name')->getQuery()->execute();

        return new GalleryCollection($galleries->toArray());
    }

    /**
     * @param Gallery $gallery
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToGallery(Gallery $gallery, $randomizedSampleSize)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['gallery.name' => $gallery->getName()], ["limit" => $randomizedSampleSize]);
        $image = $images[array_rand($images)];
        $gallery->setPrimaryImage($image);
    }

    /**
     * @param Tag $tag
     * @param int $randomizedSampleSize
     * @return Photo
     */
    public function assignPrimaryPhotoToTag(Tag $tag, $randomizedSampleSize)
    {
        /** @var Cursor $cursor */
        $images = $this->findBy(['tag.name' => $tag->getName()], ["limit" => $randomizedSampleSize]);
        $image = $images[array_rand($images)];
        $tag->setPrimaryPhoto($image);
    }

    /**
     * @param string $imageId
     * @param Tag $tag
     * @return Photo
     */
    public function getPhotoByIdAndTag($imageId, Tag $tag)
    {
        return $this->findOneBy(["gallery.name" => $tag->getName(), "id" => new \MongoId($imageId)]);
    }

    /**
     * @param string $imageId
     * @param Gallery $gallery
     * @return Photo
     */
    public function getPhotoByIdAndGallery($imageId, Gallery $gallery)
    {
        return $this->findOneBy(["gallery.name" => $gallery->getName(), "id" => new \MongoId($imageId)]);
    }


    /**
     * @param TagCollection $tags
     * @return Cursor
     */
    public function getPhotosByTags(TagCollection $tags)
    {
        return $this->createQueryBuilder()
            ->field('gallery.name')
            ->in($tags->toArray())
            ->getQuery()->execute();
    }

    /**
     * @param Gallery $gallery
     * @return Cursor
     */
    public function getPhotosFromGallery(Gallery $gallery)
    {
        return $this->createQueryBuilder()
            ->field('gallery.name')->equals($gallery->getName())
            ->getQuery()->execute();
    }
}