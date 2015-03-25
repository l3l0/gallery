<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Entity;

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
     * @param array $data
     * @throws \Exception
     * @TODO: maybe add proper validation method and check for every field. Maybe use 3rd party?
     */
    public function __construct(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = $data['name'];
        $this->cloudId = !empty($data['cloudId']) ? $data['cloudId'] : null;
        $this->url = $data['url'];

        foreach ($data['tags'] as $tag) {
            $this->tags[] = new Tag($tag);
        }

        if (empty($data['gallery'])) {
            // @TODO: add exception
            throw new \Exception();
        }
        $this->gallery = new Gallery($data['gallery']);
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
}
