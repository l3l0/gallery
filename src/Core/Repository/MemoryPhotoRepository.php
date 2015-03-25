<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Repository;

use Freyr\Gallery\Core\Entity\Photo;

/**
 * Class MemoryPhotoRepository
 * @package Freyr\Gallery\Core\Repository
 */
class MemoryPhotoRepository implements PhotoRepositoryInterface
{

    /**
     * @var Photo[]
     */
    private $photos = [];

    /**
     * @param Photo $photo
     * @return Photo
     */
    public function store(Photo $photo)
    {
        if ($photo->getId() === null) {
            $id = uniqid();
            $photo->setId($id);
        }
        $this->photos[$photo->getId()] = $photo;
    }

}
