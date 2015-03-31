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
use JsonSerializable;

/**
 * Class Photo
 * @package Freyr\Gallery\WebBundle\Document
 * @MongoDB\Document(repositoryClass="Freyr\Gallery\WebBundle\Repository\MongoDBPhotoRepository")
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
    private $cloudId;

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
     * @return mixed
     */
    public function getCloudId()
    {
        return $this->cloudId;
    }

    /**
     * @param mixed $cloudId
     */
    public function setCloudId($cloudId)
    {
        $this->cloudId = $cloudId;
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
