<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CreatePhotoFromBase64
 * @package Freyr\Gallery\Core\Interactor
 */
class CreatePhotoFromBase64 extends PhotoInteractor implements CommandInterface
{

    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var PhotoStorageInterface
     */
    private $storage;
    /**
     * @var array
     */
    private $dataStructure;

    /**
     * @param array $dataStructure
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct(array $dataStructure, PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
        $this->dataStructure = $dataStructure;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $lightroomTags = $this->dataStructure['lightroomTags'];
        $tags = $this->prepareTags($lightroomTags);
        $gallery = $this->prepareGallery($lightroomTags);

        $data = [
            'url' => 'data:' . $this->dataStructure['mime'] . ';base64,' . $this->dataStructure['base64'],
            'name' => $this->dataStructure['name'],
            'tags' => $tags,
            'gallery' => $gallery,
        ];

        $photo = new Photo($data);
        $this->storage->store($photo);
        $this->repository->store($photo);

        return $photo->asDataStructure();
    }
}
