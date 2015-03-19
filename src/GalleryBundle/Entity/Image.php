<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\GalleryBundle\Entity;

/**
 * Class Image
 * @package Freyr\Gallery\GalleryBundle\Entity
 */
abstract class Image
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
        $this->processLightroomKeywords($data['tags']);
    }

    /**
     * @param $tags
     */
    private function processLightroomKeywords($tags)
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
