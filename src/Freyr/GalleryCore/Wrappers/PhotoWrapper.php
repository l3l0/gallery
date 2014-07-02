<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryCore\Wrappers;

/**
 * Class PhotoWrapper
 * @package Freyr\GalleryCore\Wrappers
 */
class PhotoWrapper implements Wrapper {

    public static function transferCoreToBundleObject($photo)
    {
        $bundlePhoto = new BundlePhoto();

        return $bundlePhoto;
    }
} 
