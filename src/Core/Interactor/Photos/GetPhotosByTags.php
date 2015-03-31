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

/**
 * Class GetPhotosByTags
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotosByTags extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var array
     */
    private $tags;

    /**
     * @param array $tags
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(array $tags, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->tags = $tags;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosByTags($this->tags);

        $data = [];
        foreach ($photos as $photo) {
            $data[] = $photo->asDataStructure();
        }

        return $data;
    }
}