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
     * @var string
     */
    private $photoId;

    /**
     * @param string $photoId
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct($photoId, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->photoId = $photoId;
    }

    /**
     * @return GetPhotoResponse
     */
    public function execute()
    {
        $photo = $this->repository->findById($this->photoId);

        $response = new GetPhotoResponse();
        $response->smallUrl = $photo->getUrl(Photo::THUMBNAIL_SMALL);
        $response->standardUrl = $photo->getUrl(Photo::THUMBNAIL_STANDARD);
        $response->tags = $photo->getTagsAsArray();

        return $response;
    }
}
