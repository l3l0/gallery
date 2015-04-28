<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\AddImageAsPhotoInteractor;
use Freyr\Gallery\Core\RequestModel\ImageRequestModel;
use Freyr\Gallery\WebBundle\Entity\Base64ImageData;
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
     * @Route("/api/photo", name="api.photo")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createPhotoAction(Request $request)
    {
        $image = new ImageRequestModel(json_decode($request->getContent(), true));
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $addImageAsPhotoInteractor = new AddImageAsPhotoInteractor($image, $photoRepository);
        $photo = $addImageAsPhotoInteractor->execute();

        return new JsonResponse($photo);
    }
}
