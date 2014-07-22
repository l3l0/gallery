<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ManyImagesController
 * @package Freyr\GalleryBundle\Controller
 */
class ManyImagesController extends Controller {

    /**
     * @Route("/{keyword}")
     * @Template("FreyrGalleryBundle:ManyImages:index.html.twig")
     */
    public function getImagesByKeywords($keyword)
    {
        $imageService = $this->get('freyr.gallery.service.image');
        $images = $imageService->getImagesByKeywords($keyword);

        if (count($images) <= 0 )
        {
            $type = 'Gallery';
            $images = $imageService->getImagesByGallery($keyword);
        }
        else
        {
            $type = 'Tag';
        }

        return [
            'images' => $images,
            'type' => $type,
            'tagName' => $keyword
        ];
    }
}
