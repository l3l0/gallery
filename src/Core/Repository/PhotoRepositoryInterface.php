<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Repository;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\Gallery\Core\Repository
 */
interface PhotoRepositoryInterface
{

    /**
     * @param Photo $document
     * @return Photo
     */
    public function store(Photo $document);

    /**
     * @param string $photoId
     * @return Photo
     */
    public function findById($photoId);

    /**
     * @return Gallery[]
     */
    public function findAllGalleries();

    /**
     * @return Tag[]
     */
    public function findAllTags();

    /**
     * @param string $name
     * @return Photo[]
     */
    public function findPhotosFromGallery($name);

    /**
     * @param array $tags
     * @return Photo[]
     */
    public function findPhotosByTags(array $tags);

    /**
     * @param Gallery $gallery
     * @return Photo
     */
    public function getRandomPhotoFromGallery(Gallery $gallery);

    /**
     * @param Tag $tag
     * @return Photo
     */
    public function getRandomPhotoFromTag(Tag $tag);

    /**
     * @param string $gallenyName
     * @return Gallery
     */
    public function getGalleryByName($gallenyName);
}
