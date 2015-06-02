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
     * @return GetPhotosDTO
     */
    public function execute()
    {
        $photos = $this->repository->findPhotosByTags($this->tags);
        $response = new GetPhotosDTO();

        foreach ($photos as $photo) {
            $photoResponse = new GetPhotoDTO();
            $photoResponse->smallUrl = $photo->getUrl(Photo::THUMBNAIL_SMALL);
            $photoResponse->standardUrl = $photo->getUrl(Photo::THUMBNAIL_STANDARD);
            $photoResponse->tags = $photo->getTagsAsArray();

            $response->photos[] = $photoResponse;
        }

        return $response;
    }
}
