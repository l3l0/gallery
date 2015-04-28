<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\RequestModel\GalleryRequestModel;

/**
 * Class GetPhotosFromGallery
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotosFromGallery extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var string
     */
    private $galleryName;

    /**
     * @param string $galleryName
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct($galleryName, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->galleryName = $galleryName;
    }

    /**
     * @return GetPhotosFromGalleryResponseModel
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosFromGallery($this->galleryName);

        $response = [];
        foreach ($photos as $photo) {
            $response[] = new GetPhotosFromGalleryResponseModel($photo);
        }

        return $response;
    }
}
