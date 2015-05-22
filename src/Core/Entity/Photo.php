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
 * Class Image
 * @package Freyr\Gallery\Core\Entity
 */
class Photo
{

    const THUMBNAIL_STANDARD = 'standard';
    const THUMBNAIL_SMALL = 'small';

    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $url;

    /**
     * @var Tag[]
     */
    private $tags;

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
     * @param string $thumbnailSize
     * @return string
     */
    public function getUrl($thumbnailSize = self::THUMBNAIL_STANDARD)
    {
        return $this->url[$thumbnailSize];
    }

    /**
     * @param string $url
     * @param string $thumbnailSize
     */
    public function setUrl($url, $thumbnailSize = self::THUMBNAIL_STANDARD)
    {
        $this->url[$thumbnailSize] = $url;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        foreach ($tags as $tag) {
            $tag = new Tag($tag);
            $this->tags[$tag->getName()] = $tag;
        }
    }

    /**
     * @return array
     */
    public function getTagsAsArray()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->getName();
        }

        return $tags;
    }

    /**
     * @return array
     */
    public function getThumbnails()
    {
        return $this->url;
    }

    /**
     * @param array $thumbnails
     */
    public function setThumbnails($thumbnails)
    {
        $this->url = $thumbnails;
    }
}
