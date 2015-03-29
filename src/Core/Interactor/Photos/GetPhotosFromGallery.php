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
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;

/**
 * Class GetPhotosFromGallery
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotosFromGallery extends AbstractInteractor implements CommandInterface
{

    /**
     * @var GalleryRequestModel
     */
    protected $requestModel;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    /**
     * @param GalleryRequestModel $requestModel
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(GalleryRequestModel $requestModel, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->requestModel = $requestModel;
    }

    /**
     * @return PhotoResponseModel[]
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosFromGallery($this->requestModel->name);

        $data = [];
        foreach ($photos as $photo) {
            $data[] = $photo->toResponseModel();
        }

        return $data;
    }
}
