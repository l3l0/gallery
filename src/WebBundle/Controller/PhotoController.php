<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\WebBundle\Entity\Base64ImageData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PhotoController
 * @package Freyr\Gallery\WebBundle\Controller
 */
class PhotoController extends Controller
{

    /**
     * @Route("/api/photo", name="api.photo")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createPhotoAction(Request $request)
    {
        $image = new Base64ImageData(json_decode($request->getContent(), true));
        $rawPhotoService = $this->get('freyr.gallery.service.photo.raw');
        $photo = $rawPhotoService->store($image);

        return new JsonResponse($photo);
    }
}
