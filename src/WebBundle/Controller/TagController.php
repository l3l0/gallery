<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\TagFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TagController
 * @package Freyr\Gallery\WebBundle\Controller
 */
class TagController extends Controller
{

    /**
     * @Route("/tag/{name}", name="tag")
     * @Template("FreyrGalleryWebBundle:Tag:index.html.twig")
     * @Method("GET")
     * @param string $name
     * @return array
     */
    public function getPhotosAction($name)
    {
        $imageService = $this->get('freyr.gallery.service.photo');
        $tags = TagFactory::createTagsFromList($name, 'Freyr\Gallery\WebBundle\Document\Tag');
        $photos = $imageService->getPhotosByTags($tags);

        return [
            'photos' => $photos,
            'tags' => $tags
        ];
    }
}
