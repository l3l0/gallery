<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Entity;

use Freyr\Gallery\Core\RequestModel\ImageRequestModel;
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;

/**
 * Class Photo
 * @package Freyr\Gallery\Core\Entity
 */
class Photo
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cloudId;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Gallery
     */
    private $gallery;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * @param ImageRequestModel $image
     * @throws \Exception
     */
    public function __construct(ImageRequestModel $image)
    {
        $this->id = $image->id;
        $this->name = $image->name;
        $this->cloudId = $image->cloudId;
        $this->url = $image->url;

        // TODO: add exception when data['tags'] is not defined
        if (count($image->tags) <= 0) {
            throw new \Exception();
        }
        foreach ($image->tags as $tag) {
            $this->tags[] = new Tag($tag);
        }
    }

    /**
     * @return null|string
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCloudId()
    {
        return $this->cloudId;
    }

    /**
     * @param string $cloudId
     */
    public function setCloudId($cloudId)
    {
        $this->cloudId = $cloudId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @return PhotoResponseModel
     */
    public function toResponseModel()
    {
        $data = new PhotoResponseModel();
        $data->cloudId = $this->cloudId;
        $data->gallery = $this->gallery->getName();
        foreach ($this->tags as $tag) {
            $data->tags[] = $tag->getName();
        }
        $data->name = $this->name;
        $data->photoId = $this->id;
        $data->url = $this->url;

        return $data;
    }
}
