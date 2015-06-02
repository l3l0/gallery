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
 * Class Tag
 * @package Freyr\Gallery\Core\Entity
 */
class Tag
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var CoverPhoto
     */
    private $coverPhoto;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $this->sanitizeName($name);
    }

    /**
     * @param $name
     * @return string
     */
    private function sanitizeName($name)
    {
        return strtolower(str_replace(' ', '-', trim($name)));
    }

    /**
     * @return mixed
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
     * @param CoverPhoto $photo
     */
    public function setCoverPhoto(CoverPhoto $photo)
    {
        $this->coverPhoto = $photo;
    }
}
