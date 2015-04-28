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
use Freyr\Gallery\Core\RequestModel\ImageRequestModel;

/**
 * Class AddImageAsPhotoInteractor
 * @package Freyr\Gallery\Core\Interactor
 */
class AddImageAsPhotoInteractor extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var ImageRequestModel
     */
    private $image;

    /**
     * @param ImageRequestModel $image
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(ImageRequestModel $image, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->image = $image;
    }

    /**
     * @return AddImageAsPhotoResponseModel
     */
    public function execute()
    {
        $photo = new Photo($this->image);
        $this->repository->store($photo);

        return new AddImageAsPhotoResponseModel($photo);
    }
}
