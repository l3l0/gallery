<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Tags\GetTags;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomeController
 * @package Freyr\Gallery\WebBundle\Controller
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     * @Template("FreyrGalleryWebBundle:Home:index.html.twig")
     */
    public function getHomeAction()
    {
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $getTagsInteractor = new GetTags($photoRepository);

        return [
            'tags' => $getTagsInteractor->execute(),
        ];
    }

    /**
     * @Route("/about", name="about")
     * @Method("GET")
     * @Template("FreyrGalleryWebBundle:Home:about.html.twig")
     */
    public function getAboutAction()
    {
        return ['page' => 'about'];
    }
}
