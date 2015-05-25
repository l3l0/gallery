<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\AddPhoto;
use Freyr\Gallery\Core\Interactor\Photos\GetPhotoById;
use Freyr\Gallery\Core\Interactor\Photos\GetPhotosByTags;
use Freyr\Gallery\Core\Interactor\Tags\GetTags;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @package Freyr\Gallery\WebBundle\Controller
 */
class ApiController extends Controller
{

    /**
     * @Route("/api/photos", name="api.photos")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createPhotoAction(Request $request)
    {
        $content = json_decode($request->getContent());
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $addPhotoInteractor = new AddPhoto($content->tags, $content->urls, $photoRepository);
        $response = $addPhotoInteractor->execute();

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/photos", name="api.photos")
     * @Method("GET")
     * @return JsonResponse
     */
    public function getPhotosAction()
    {
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $tagsInteractor = new GetTags($photoRepository);
        $photosInteractor = new GetPhotosByTags($tagsInteractor->execute()->asArray(), $photoRepository);
        $response = $photosInteractor->execute();

        return new JsonResponse($response);
    }

    /**
     * @Route("/api/photos/{photoId}", name="api.photo")
     * @Method("GET")
     * @return JsonResponse
     */
    public function getPhotoAction($photoId)
    {
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $photosInteractor = new GetPhotoById($photoId, $photoRepository);
        $response = $photosInteractor->execute();

        return new JsonResponse($response);
    }
}
