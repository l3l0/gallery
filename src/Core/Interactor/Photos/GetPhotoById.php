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
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;

/**
 * Class GetPhotoById
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotoById extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRequestModel
     */
    protected $requestModel;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    /**
     * @param PhotoRequestModel $requestModel
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(PhotoRequestModel $requestModel, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->requestModel = $requestModel;
    }

    /**
     * @return PhotoResponseModel
     */
    public function execute()
    {
        $photo = $this->repository->findById($this->requestModel->photoId);
        return $photo->toResponseModel();
    }
}
