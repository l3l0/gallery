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
 * Class Base64ImageData
 * @package Freyr\GalleryBundle\Entity
 */
class FileImageData extends ImageData
{

    /**
     * @var string
     */
    public $path = '';

    /**
     * @param array $data
     */
    public function __constructor(array $data)
    {
        parent::__construct($data);
        $this->path = $data['path'];
    }

    /**
     * @return string
     */
    public function getImageForStorage()
    {
        return $this->path;
    }


}
