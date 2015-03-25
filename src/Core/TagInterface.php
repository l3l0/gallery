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
 * Interface TagInterface
 * @package Freyr\Gallery\Core
 */
interface TagInterface
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
    public function getPrimaryPhoto();

    /**
     * @param PhotoInterface $primaryPhoto
     */
    public function setPrimaryPhoto(PhotoInterface $primaryPhoto);
}
