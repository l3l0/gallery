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
 * Class Image
 * @package Freyr\GalleryBundle\Document
 * @MongoDB\Document(repositoryClass="Freyr\GalleryBundle\Repository\ImageRepository")
 */
class Image {

    /**
     * @MongoDB\Id
     * @var string
     */
    private $id;

    /**
     * @MongoDB\String
     * @var string
     */
    private $keyword;

    /**
     * @MongoDB\String
     * @var string
     */
    private $cloudinaryId;

    /**
     * @return string
     */
    public function getCloudinaryId()
    {
        return $this->cloudinaryId;
    }

    /**
     * @param string $cloudinaryId
     */
    public function setCloudinaryId($cloudinaryId)
    {
        $this->cloudinaryId = $cloudinaryId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }
}
