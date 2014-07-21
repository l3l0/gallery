<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Controller;

use Freyr\GalleryBundle\Service\ImageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomeController
 * @package Freyr\GalleryBundle\Controller
 */
class HomeController extends Controller {

    /**
     * @Route("/")
     * @Template("FreyrGalleryBundle:Home:index.html.twig")
     */
    public function getHomeAction()
    {
        $imageService = $this->get('freyr.gallery.service.image');

        return [
            'keywords' => $imageService->getKeywordsList(),
            'categories' => $imageService->getAllCategories()
        ];
    }
}
