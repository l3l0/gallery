<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Document;

/**
 * Class LightroomImage
 * @package Freyr\GalleryBundle\Document
 */
class LightroomImage {

    /**
     * @var string
     */
    private $rawImageContent;
    /**
     * @var array
     */
    private $tags = [];
    /**
     * @var string
     */
    private $gallery;

    /**
     * @return string
     */
    public function getRawImageContent()
    {
        return $this->rawImageContent;
    }

    /**
     * @param string $rawImageContent
     */
    public function setRawImageContent($rawImageContent)
    {
        $this->rawImageContent = $rawImageContent;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param string $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }
}
