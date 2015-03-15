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
class Base64ImageData extends ImageData
{

    /**
     * @var string
     */
    public $content = '';

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->content = 'data:image/png;base64,' . $data['content'];
    }

    /**
     * @return string
     */
    public function getImageForStorage()
    {
        return $this->content;
    }


}
