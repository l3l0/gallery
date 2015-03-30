<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CreatePhotoFromBase64
 * @package Freyr\Gallery\Core\Interactor
 */
class CreatePhotoFromBase64 extends AbstractInteractor implements CommandInterface
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
     * @var PhotoStorageInterface
     */
    private $storage;

    /**
     * @param PhotoRequestModel $requestModel
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct(PhotoRequestModel $requestModel, PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
        $this->requestModel = $requestModel;
    }

    /**
     * @return PhotoResponseModel
     */
    public function execute()
    {
        $data = [
            'url' => 'data:' . $this->requestModel->imageMime . ';base64,' . $this->requestModel->url,
            'name' => $this->requestModel->name,
            'tags' => $this->requestModel->tags,
            'gallery' => $this->requestModel->gallery
        ];

        $photo = new Photo($data);
        $this->storage->store($photo);
        $this->repository->store($photo);

        return $photo->toResponseModel();
    }
}
