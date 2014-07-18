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
     * @MongoDB\EmbedMany(targetDocument="Keyword")
     * @var Keyword[]
     */
    private $keywords = [];

    /**
     * @MongoDB\String
     * @var string
     */
    private $cloudinaryId;

    /**
     * @MongoDB\String
     * @var string
     */
    private $importPath;

    /**
     * @MongoDB\String
     * @var string
     */
    private $exposureTime;

    /**
     * @MongoDB\String
     * @var string
     */
    private $fNumber;

    /**
     * @MongoDB\String
     * @var string
     */
    private $iso;

    /**
     * @MongoDB\String
     * @var string
     */
    private $createdAt;

    /**
     * @MongoDB\String
     * @var string
     */
    private $focalLength;

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
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @param $keyword
     */
    public function addKeyword($keyword)
    {
        $this->keywords[] = $keyword;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $exposureTime
     */
    public function setExposureTime($exposureTime)
    {
        $this->exposureTime = $exposureTime;
    }

    /**
     * @return string
     */
    public function getExposureTime()
    {
        return $this->exposureTime;
    }

    /**
     * @param string $fNumber
     */
    public function setFNumber($fNumber)
    {
        $this->fNumber = $fNumber;
    }

    /**
     * @return string
     */
    public function getFNumber()
    {
        return $this->fNumber;
    }

    /**
     * @param string $focalLength
     */
    public function setFocalLength($focalLength)
    {
        $this->focalLength = $focalLength;
    }

    /**
     * @return string
     */
    public function getFocalLength()
    {
        return $this->focalLength;
    }

    /**
     * @param string $importPath
     */
    public function setImportPath($importPath)
    {
        $this->importPath = $importPath;
    }

    /**
     * @return string
     */
    public function getImportPath()
    {
        return $this->importPath;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }


}
