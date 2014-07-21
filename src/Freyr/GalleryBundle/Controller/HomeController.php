<?php
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
        $imageRepository = $this->get('freyr.gallery.repository.image');
        $imageService = new ImageService($imageRepository);
        $keywords = $imageService->getKeywordsList();

        return [
            'keywords' => $keywords
        ];
    }
}
