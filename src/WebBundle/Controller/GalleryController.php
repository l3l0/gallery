<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotosFromGallery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GalleryController
 * @package Freyr\Gallery\WebBundle\Controller
 */
class GalleryController extends Controller
{

    /**
     * @Route("/gallery/{name}", name="gallery")
     * @Method("GET")
     * @Template("FreyrGalleryWebBundle:Gallery:index.html.twig")
     * @param $name
     * @return array
     */
    public function getPhotosAction($name)
    {
        $interactor = new GetPhotosFromGallery($name, $this->get('freyr.gallery.repository.photo'));
        $photos = $interactor->execute();
        return [
            'photos' => $photos,
            'gallery' => $name
        ];
    }
}
