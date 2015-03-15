<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Entity;

/**
 * Class ImageData
 * @package Freyr\GalleryBundle\Entity
 */
abstract class ImageData
{

    /**
     * @var array
     */
    private $tags = [];

    /**
     * @var string
     */
    private $gallery = '';

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        // TODO: refactor name, separate gallery fetching
        $this->parseTags($data['tags']);
        // TODO: add more image properties
    }

    /**
     * @param $tags
     */
    private function parseTags($tags)
    {
        foreach ($tags as $tag) {
            if (preg_match('/Gallery:', $tag)) {
                if ($this->gallery !== '') {
                    $this->gallery = str_replace('Gallery: ', '', $tag);
                }
            } else {
                $this->tags[] = $tag;
            }
        }
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @return string
     */
    public abstract function getImageForStorage();
}
