<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Freyr\Gallery\Core\GalleryInterface;
use Freyr\Gallery\Core\PhotoInterface;

/**
 * Class Gallery
 * @package Freyr\Gallery\WebBundle\Document
 * @MongoDB\EmbeddedDocument
 */
class Gallery implements GalleryInterface
{

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @var Photo
     */
    private $primaryImage;

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
    public function getPrimaryImage()
    {
        return $this->primaryImage;
    }

    /**
     * @param PhotoInterface $primaryImage
     */
    public function setPrimaryImage(PhotoInterface $primaryImage)
    {
        $this->primaryImage = $primaryImage;
    }
}
