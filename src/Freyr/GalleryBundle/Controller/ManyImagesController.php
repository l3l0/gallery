<?php

namespace Freyr\GalleryBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManyImagesController extends Controller {

    /**
     * @Route("/{keyword}")
     * @Template("FreyrGalleryBundle:ManyImages:index.html.twig")
     */
    public function getImagesByKeywords($keyword)
    {
        $imageRepository = $this->get('freyr.gallery.repository.image');
        if (strpos($keyword, ',') != false)
        {
            $keywords = explode(',', $keyword);
        }
        else
        {
            $keywords = [$keyword];
        }
        $images = $imageRepository->getByKeywords($keywords);

        return [
            'images' => $images

        ];
    }
}