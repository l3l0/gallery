<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\GalleryBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Tag
 * @package Freyr\Gallery\GalleryBundle\Document
 * @MongoDB\EmbeddedDocument
 */
class Tag
{

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @var Photo
     */
    private $primaryPhoto;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = strtolower(str_replace(' ', '-', $name));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Photo
     */
    public function getPrimaryPhoto()
    {
        return $this->primaryPhoto;
    }

    /**
     * @param Photo $primaryPhoto
     */
    public function setPrimaryPhoto(Photo $primaryPhoto)
    {
        $this->primaryPhoto = $primaryPhoto;
    }
}
