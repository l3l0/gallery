<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Entity;

use Freyr\Gallery\WebBundle\Document\Gallery;

/**
 * Class GalleryCollection
 * @package Freyr\Gallery\WebBundle\Document
 */
class GalleryCollection
{

    /**
     * @var Gallery[]
     */
    private $gallery = [];

    /**
     * @param mixed $galleries
     */
    public function __construct($galleries)
    {
        $this->createGalleries($galleries);
    }

    /**
     * @param mixed $galleries
     */
    private function createGalleries($galleries)
    {
        if (is_array($galleries)) {
            foreach ($galleries as $gallery) {
                if (!$galleries instanceof Gallery) {
                    $gallery = new Gallery($gallery);
                }
                $this->gallery[$gallery->getName()] = $gallery;
            }
        } else {
            if (!$galleries instanceof Gallery) {
                $galleries = new Gallery($galleries);
            }
            $this->gallery[$galleries->getName()] = $galleries;
        }
    }

    /**
     * @param mixed $gallery
     */
    public function addGallery($gallery)
    {
        $this->createGalleries($gallery);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $galleries = [];
        foreach ($this->gallery as $gallery) {
            $galleries[] = $gallery->getName();
        }

        return $galleries;
    }
}
