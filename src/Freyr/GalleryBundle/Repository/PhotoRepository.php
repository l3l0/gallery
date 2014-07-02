<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Repository;

use Freyr\GalleryCore\Repository\PhotoRepositoryInterface;

/**
 * Class PhotoRepository
 * @package Freyr\GalleryBundle\Repository
 */
class PhotoRepository implements PhotoRepositoryInterface {

    /**
     * Gets one photo that meet criteria (keyword and photo id)
     * @param string $keyword
     * @param string $photoId
     * @return mixed
     */
    public function getByKeywordAndId($keyword, $photoId)
    {
        // TODO: Implement getByKeywordAndId() method.
    }
}
