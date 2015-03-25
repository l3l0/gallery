<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

class GetPhotoByIdAndGallery extends AbstractInteractor implements CommandInterface
{

    /**
     * @var Gallery
     */
    private $gallery;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    private $photoId;

    public function __construct($photoId, Gallery $gallery, PhotoRepositoryInterface $repository)
    {
        $this->gallery = $gallery;
        $this->repository = $repository;
        $this->photoId = $photoId;
    }

    public function execute()
    {
        $photo = $this->repository->findById($this->photoId);
        $photo->setGallery($this->gallery);

        return $photo;
    }
}
