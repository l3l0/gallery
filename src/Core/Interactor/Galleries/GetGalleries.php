<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Galleries;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;

/**
 * Class GetGalleries
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class GetGalleries extends AbstractInteractor implements CommandInterface
{
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    /**
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Gallery[]
     * @throws \Exception
     */
    public function execute()
    {
        $galleries = $this->repository->findAllGalleries();
        $result = [];
        foreach ($galleries as $gallery) {
            $result[] = $gallery->asDataStructure();
        }

        return $result;
    }
}