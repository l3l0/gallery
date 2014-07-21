<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Keyword
 * @package Freyr\GalleryBundle\Document
 * @MongoDB\EmbeddedDocument
 */
class Keyword {

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @var Image
     */
    private $primaryImage;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = str_replace(' ', '-', $name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Image
     */
    public function getPrimaryImage()
    {
        return $this->primaryImage;
    }

    /**
     * @param Image $primaryImage
     */
    public function setPrimaryImage($primaryImage)
    {
        $this->primaryImage = $primaryImage;
    }
}
