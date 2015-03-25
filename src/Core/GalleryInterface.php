<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core;

/**
 * Interface GalleryInterface
 * @package Freyr\Gallery\Core
 */
interface GalleryInterface
{

    /**
     * @param string $name
     */
    public function __construct($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return PhotoInterface
     */
    public function getPrimaryImage();

    /**
     * @param PhotoInterface $primaryImage
     */
    public function setPrimaryImage(PhotoInterface $primaryImage);
}
