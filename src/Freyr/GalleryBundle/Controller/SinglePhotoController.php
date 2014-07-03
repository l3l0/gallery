<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class SinglePhotoController
 * @package Freyr\GalleryBundle\Controller
 */
class SinglePhotoController extends Controller {

    /**
     * @Route("/{keyword}/{imageId}")
     * @Template("FreyrGalleryBundle:SinglePhoto:index.html.twig")
     */
    public function indexAction($keyword, $imageId)
    {
        return [
            'keyword' => $keyword,
            'photo' => $imageId
        ];
    }

} 
