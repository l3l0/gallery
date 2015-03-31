<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Controller;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromBase64;
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
        $data = json_decode($request->getContent(), true);
        $interactor = new CreatePhotoFromBase64($data, $this->get('freyr.gallery.repository.photo'), $this->get('freyr.gallery.storage.photo'));
        $photo = $interactor->execute();
        return new JsonResponse($photo);
    }
}
