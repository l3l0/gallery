<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Twig;

/**
 * Class CloudinaryExtension
 * @package Freyr\Gallery\FreyrGalleryWebBundle\Twig
 */
class CloudinaryExtension extends \Twig_Extension
{

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
     * @param bool $thumb
     * @return string
     */
    public function cloudinaryFunction($publicId, $height = 0, $thumb = true)
    {
        $params = [];
        if ($thumb === true) {
            $params['width'] = $height;
            $params['height'] = $height;
            $params['crop'] = 'fill';
            $params['gravity'] = 'faces';
        }
        ($height === 0) ?: $params['height'] = $height;

        return cloudinary_url($publicId, $params) . '.jpg';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cloudinary_extension';
    }

}