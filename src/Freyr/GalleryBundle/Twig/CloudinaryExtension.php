<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\GalleryBundle\Twig;

/**
 * Class CloudinaryExtension
 * @package Freyr\GalleryBundle\Twig
 */
class CloudinaryExtension extends \Twig_Extension {

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('cl', [$this, 'cloudinaryFunction'])
        ];
    }

    /**
     * @param string $publicId
     * @param int $height
     * @param int $width
     * @return string
     */
    public function cloudinaryFunction($publicId, $height = 0, $width = 0)
    {
        $params = [];
        ($width === 0) ?: $params['width'] = $width;
        ($height === 0) ?: $params['height'] = $height;
        return cloudinary_url($publicId, $params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cloudinary_extension';
    }

} 
