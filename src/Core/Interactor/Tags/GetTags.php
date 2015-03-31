<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 22:18
 */

namespace Freyr\Gallery\Core\Interactor\Tags;

use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;

/**
 * Class GetGalleries
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class GetTags extends AbstractInteractor implements CommandInterface
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
     * @return array
     * @throws \Exception
     */
    public function execute()
    {
        $tags = $this->repository->findAllTags();
        $result = [];
        foreach ($tags as $tag) {
            $result[] = $tag->asDataStructure();
        }

        return $result;
    }
}