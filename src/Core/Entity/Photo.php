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
    protected $cloudId;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var Gallery
     */
    protected $gallery;
    /**
     * @var Tag[]
     */
    protected $tags;
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @param array $data
     * @throws \Exception
     * TODO: maybe add proper validation method and check for every field. Maybe use 3rd party?
     */
    public function __construct(array $data)
    {
        if (!isset($data['tags'])) {
            throw new \Exception();
        }
        if (empty($data['gallery'])) {
            throw new \Exception();
        }

        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->cloudId = !empty($data['cloudId']) ? $data['cloudId'] : null;

        $this->name = $data['name'];
        $this->url = $data['url'];

        $this->gallery = new Gallery($data['gallery']);

        foreach ($data['tags'] as $tag) {
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
     * @return array
     */
    public function asDataStructure()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->asDataStructure();
        }

        return [
            'id' => $this->id,
            'cloudId' => $this->cloudId,
            'url' => $this->url,
            'name' => $this->name,
            'gallery' => $this->gallery->asDataStructure(),
            'tags' => $tags,
        ];
    }
}
