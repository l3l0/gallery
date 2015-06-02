<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotosByTags;
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
        $tags = explode(',', $name);
        $interactor = new GetPhotosByTags($tags, $this->get('freyr.gallery.repository.photo'));
        $photos = $interactor->execute();

        return [
            'photos' => $photos,
            'tags' => $tags
        ];
    }
}
