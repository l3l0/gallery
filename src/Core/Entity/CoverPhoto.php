<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Entity;

/**
 * Class CoverPhoto
 * @package Freyr\Gallery\Core\Entity
 */
class CoverPhoto
{
    /**
     * @var Photo
     */
    private $photo;

    /**
     * @param Photo $photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->photo->getUrl(Photo::THUMBNAIL_SMALL);
    }
}
