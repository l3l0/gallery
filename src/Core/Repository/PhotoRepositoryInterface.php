<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Repository;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Entity\Photo;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\Gallery\Core\Repository
 */
interface PhotoRepositoryInterface
{

    /**
     * @param Photo $photo
     * @return Photo
     */
    public function store(Photo $photo);

    /**
     * @param string $photoId
     * @return Photo
     */
    public function findById($photoId);

    /**
     * @return Gallery[]
     */
    public function findAllGalleries();
}
