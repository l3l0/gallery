<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\AddImageAsPhoto;
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
     * @Route("/api/image", name="api.image")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createPhotoAction(Request $request)
    {
        $content = json_decode($request->getContent());
        $photoRepository = $this->get('freyr.gallery.repository.photo');
        $addImageAsPhotoInteractor = new AddImageAsPhoto($content->tags, $content->urls, $photoRepository);
        $response = $addImageAsPhotoInteractor->execute();

        return new JsonResponse($response);
    }
}
