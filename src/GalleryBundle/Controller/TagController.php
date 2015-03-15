<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryBundle\Controller;

use Freyr\GalleryBundle\Document\TagCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TagController
 * @package Freyr\GalleryBundle\Controller
 */
class TagController extends Controller
{

    /**
     * @Route("/tag/{name}", name="tag")
     * @Template("FreyrGalleryBundle:Tag:index.html.twig")
     */
    public function getPhotosAction($name)
    {
        $imageService = $this->get('freyr.gallery.service.photo');
        $tags = new TagCollection($name);
        $photos = $imageService->getPhotosByTags($tags);

        return [
            'photos' => $photos,
            'tags' => $tags
        ];
    }
}
