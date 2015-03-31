<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Storage;

use Freyr\Gallery\Core\Entity\Photo;

/**
 * Class MemoryPhotoStorage
 * @package Freyr\Gallery\Core\Storage
 */
class MemoryPhotoStorage implements PhotoStorageInterface
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
        $cloudId = uniqid();
        $photo->setCloudId($cloudId);
        $photo->setUrl('http://example.com/memory.gif');
        $this->photos[$cloudId] = $photo;
    }


}
