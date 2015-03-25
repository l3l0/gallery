<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Freyr\Gallery\Core\PropertyInterface;

/**
 * Class Property
 * @package Freyr\Gallery\WebBundle\Entity
 * @MongoDB\EmbeddedDocument
 */
class Property implements PropertyInterface
{

    /**
     * @MongoDB\String
     * @var string
     */
    private $publicId;
    /**
     * @MongoDB\String
     * @var string
     */
    private $version;
    /**
     * @MongoDB\String
     * @var string
     */
    private $signature;
    /**
     * @MongoDB\String
     * @var string
     */
    private $width;
    /**
     * @MongoDB\String
     * @var string
     */
    private $height;
    /**
     * @MongoDB\String
     * @var string
     */
    private $format;
    /**
     * @MongoDB\String
     * @var string
     */
    private $resource_type;
    /**
     * @MongoDB\String
     * @var string
     */
    private $createdAt;
    /**
     * @MongoDB\Hash
     * @var array
     */
    private $tags;
    /**
     * @MongoDB\Int
     * @var int
     */
    private $bytes;
    /**
     * @MongoDB\String
     * @var string
     */
    private $type;
    /**
     * @MongoDB\String
     * @var string
     */
    private $etag;
    /**
     * @MongoDB\String
     * @var string
     */
    private $url;
    /**
     * @MongoDB\String
     * @var string
     */
    private $secureUrl;

    /**
     * @param array $cloudinaryResponse
     */
    public function __construct(array $cloudinaryResponse)
    {
        $this->publicId = $cloudinaryResponse['public_id'];
        $this->version = $cloudinaryResponse['version'];
        $this->signature = $cloudinaryResponse['signature'];
        $this->width = $cloudinaryResponse['width'];
        $this->height = $cloudinaryResponse['height'];
        $this->format = $cloudinaryResponse['format'];
        $this->resource_type = $cloudinaryResponse['resource_type'];
        $this->createdAt = $cloudinaryResponse['created_at'];
        $this->tags = $cloudinaryResponse['tags'];
        $this->bytes = $cloudinaryResponse['bytes'];
        $this->type = $cloudinaryResponse['type'];
        $this->etag = $cloudinaryResponse['etag'];
        $this->url = $cloudinaryResponse['url'];
        $this->secureUrl = $cloudinaryResponse['secure_url'];
    }

    /**
     * @return mixed
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getResourceType()
    {
        return $this->resource_type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getBytes()
    {
        return $this->bytes;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getSecureUrl()
    {
        return $this->secureUrl;
    }
}
