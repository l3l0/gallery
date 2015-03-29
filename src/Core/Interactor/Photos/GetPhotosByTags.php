<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 21:34
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;

/**
 * Class GetPhotosByTags
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotosByTags extends AbstractInteractor implements CommandInterface
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
     * @return PhotoResponseModel[]
     * @throws \Exception
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosByTags($this->requestModel->tags);

        $data = [];
        foreach ($photos as $photo) {
            $data[] = $photo->toResponseModel();
        }

        return $data;
    }
}