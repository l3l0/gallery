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
 * Class Gallery
 * @package Freyr\Gallery\Core\Entity
 */
class Gallery
{

    /**
     * @var CoverPhoto
     */
    private $coverPhoto;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $this->sanitizeName($data['name']);
    }

    /**
     * @param string $name
     * @return string
     */
    private function sanitizeName($name)
    {
        return strtolower(str_replace(' ', '-', trim($name)));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return CoverPhoto
     */
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    /**
     * @param Photo $photo
     */
    public function setCoverPhoto(Photo $photo)
    {
        $this->coverPhoto = new CoverPhoto($photo);
    }

    /**
     * @return array
     */
    public function asDataStructure()
    {
        $result = [];
        if ($this->coverPhoto instanceof CoverPhoto) {
            $result['coverPhoto'] = $this->coverPhoto->asDataStructure();
        }
        $result['name'] = $this->name;

        return $result;
    }
}
