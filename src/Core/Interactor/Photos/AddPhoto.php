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
 * Class AddPhoto
 * @package Freyr\Gallery\Core\Interactor
 */
class AddPhoto extends AbstractInteractor implements CommandInterface
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
     * @var array
     */
    private $urls;

    /**
     * @param array $tags
     * @param array $urls
     * @param PhotoRepositoryInterface $repository
     */
    public function __construct(array $tags, array $urls, PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->tags = $tags;
        $this->urls = $urls;
    }

    /**
     * @return AddPhotoDTO
     */
    public function execute()
    {
        $photo = new Photo();
        $photo->setTags($this->tags);
        $photo->setUrl($this->urls);
        $this->repository->store($photo);

        $response = new AddPhotoDTO();
        if ($photo->getId() !== false) {
            $response->status = true;
            $response->id = $photo->getId();
        }

        return $response;
    }
}
