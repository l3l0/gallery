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
use Freyr\Gallery\WebBundle\Entity\Property;
use JsonSerializable;

/**
 * Class Photo
 * @package Freyr\Gallery\WebBundle\Document
 * @MongoDB\Document(repositoryClass="Freyr\Gallery\WebBundle\Repository\MongoDB\MongoDBPhotoRepository")
 */
class Photo implements JsonSerializable
{

    /**
     * @MongoDB\Id
     * @var string
     */
    private $id;

    /**
     * @MongoDB\EmbedOne(targetDocument="Gallery")
     * @var Gallery
     */
    private $gallery;

    /**
     * @MongoDB\EmbedOne(targetDocument="Property")
     * @var Property
     */
    private $property;

    /**
     * @MongoDB\EmbedMany(targetDocument="Tag")
     * @var Tag[]
     */
    private $tags = [];

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

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
     * @MongoDB\String
     * @var string
     */
    private $currentTag;

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param Property $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return Tag
     */
    public function getCurrentTag()
    {
        return $this->currentTag;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $photoId
     */
    public function setId($photoId)
    {
        $this->id = $photoId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $photoName
     */
    public function setName($photoName)
    {
        $this->name = $photoName;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
    public function getExposureTime()
    {
        return $this->exposureTime;
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
    public function getFNumber()
    {
        return $this->fNumber;
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
    public function getFocalLength()
    {
        return $this->focalLength;
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
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return [
            "name" => $this->name
        ];
    }


}
