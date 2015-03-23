<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\GalleryBundle\Entity;

use Freyr\Gallery\GalleryBundle\Document\Tag;

/**
 * Class TagCollection
 * @package Freyr\Gallery\GalleryBundle\Entity
 */
class TagCollection
{

    /**
     * @var Tag[]
     */
    private $tags = [];

    /**
     * @param $tags
     */
    public function __construct($tags)
    {
        $this->createTags($tags);
    }

    /**
     * @param mixed $tags
     */
    private function createTags($tags)
    {
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                if (!$tag instanceof Tag) {
                    $tag = new Tag($tag);
                }
                $this->tags[$tag->getName()] = $tag;
            }
        } else {
            if (!$tags instanceof Tag) {
                if (strpos($tags, ',')) {
                    $tags = split(',', $tags);
                    $this->createTags($tags);
                }
                $tags = new Tag($tags);
            }
            $this->tags[$tags->getName()] = $tags;
        }
    }

    /**
     * @param mixed $tag
     */
    public function addTag($tag)
    {
        $this->createTags($tag);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->getName();
        }

        return $tags;
    }
}
