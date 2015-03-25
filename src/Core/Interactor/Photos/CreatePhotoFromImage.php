<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Image;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CreatePhotoFromRawData
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class CreatePhotoFromImage extends AbstractInteractor implements CommandInterface
{

    /**
     * @var Image
     */
    private $image;
    /**
     * @var PhotoStorageInterface
     */
    private $storage;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    /**
     * @param Image $image
     * @param PhotoStorageInterface $storage
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(Image $image, PhotoStorageInterface $storage, PhotoRepositoryInterface $repository)
    {
        $this->image = $image;
        $this->storage = $storage;
        $this->repository = $repository;
    }

    public function execute()
    {
        $this->storage->store($this->image);
        $photo = new Photo($this->image);
        $this->repository->store($photo);
    }
}
