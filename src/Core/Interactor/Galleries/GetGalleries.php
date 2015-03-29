<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 22:18
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

        return $galleries;
    }
}