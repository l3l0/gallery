<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\GalleryBundle\Controller;

use Freyr\Gallery\GalleryBundle\Document\Gallery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GalleryController
 * @package Freyr\Gallery\GalleryBundle\Controller
 */
class GalleryController extends Controller
{

    /**
     * @Route("/gallery/{name}", name="gallery")
     * @Method("GET")
     * @Template("FreyrGalleryBundle:Gallery:index.html.twig")
     * @param $name
     * @return array
     */
    public function getPhotosAction($name)
    {
        $imageService = $this->get('freyr.gallery.service.photo');
        $gallery = new Gallery($name);
        $photos = $imageService->getPhotosFromGallery($gallery);

        return [
            'photos' => $photos,
            'gallery' => $gallery
        ];
    }
}
