<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Tags;

use Freyr\Gallery\Core\Entity\CoverPhoto;
use Freyr\Gallery\Core\Entity\CoverPhotoResponse;
use Freyr\Gallery\Core\Entity\TagResponse;
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
     * @return GetTagsResponse
     */
    public function execute()
    {
        $tags = $this->repository->findAllTags();
        foreach ($tags as $tag) {
            $tag->setCoverPhoto(new CoverPhoto($this->repository->getRandomPhotoFromTag($tag)));
        }

        $response = new GetTagsResponse();
        foreach ($tags as $tag) {
            $tagResponse = new TagResponse();
            $tagResponse->name = $tag->getName();
            $coverPhotoResponse = new CoverPhotoResponse();
            $coverPhotoResponse->url = $tag->getCoverPhoto()->getUrl();
            $tagResponse->coverPhoto = $coverPhotoResponse;

            $response->tags[] = $tagResponse;
        }

        return $response;
    }
}
