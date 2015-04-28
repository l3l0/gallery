<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Tags;

use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;

/**
 * Class GetTagsWithPrimaryPhoto
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class GetTagsWithPrimaryPhoto extends AbstractInteractor implements CommandInterface
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
     * @return GetTagsWithPrimaryPhotoResponseModel[]
     * @throws \Exception
     */
    public function execute()
    {
        $tags = $this->repository->findAllTags();

        $response = [];
        foreach ($tags as $tag) {
            $photo = $this->repository->getRandomPhotoFromTag($tag);
            $tag->setCoverPhoto($photo);

            $response[] = new GetTagsWithPrimaryPhotoResponseModel($tag);
        }

        return $response;
    }
}
