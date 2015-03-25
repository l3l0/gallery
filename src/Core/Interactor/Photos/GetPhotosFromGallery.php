<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

class GetPhotosFromGallery extends AbstractInteractor implements CommandInterface
{

    /**
     * @var Gallery
     */
    private $gallery;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    public function __construct(Gallery $gallery, PhotoRepositoryInterface $repository)
    {
        $this->gallery = $gallery;
        $this->repository = $repository;
    }

    public function execute()
    {
        $photos = $this->repository->findByGallery($this->gallery);

        return $photos;
    }
}
