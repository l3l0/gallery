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
 * Class GetPhotoById
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotoById extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var
     */
    private $photoId;

    /**
     * @param $photoId
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct($photoId, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->photoId = $photoId;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $photo = $this->repository->findById($this->photoId);
        return $photo->asDataStructure();
    }
}
