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
    private $gallery;

    /**
     * @param string $gallery
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct($gallery, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->gallery = $gallery;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosFromGallery($this->gallery);

        $data = [];
        foreach ($photos as $photo) {
            $data[] = $photo->asDataStructure();
        }

        return $data;
    }
}
