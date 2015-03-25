<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Base64Image;
use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\AbstractInteractor;
use Freyr\Gallery\Core\Interactor\CommandInterface;
use Freyr\Gallery\Core\Repository\PhotoRepositoryInterface;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CreatePhotoFromBase64
 * @package Freyr\Gallery\Core\Interactor
 */
class CreatePhotoFromBase64 extends AbstractInteractor implements CommandInterface
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
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct(PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
    }

    /**
     * @return Base64Image
     * @TODO Add image type to base64 header
     */
    public function execute()
    {
        parent::execute();
        $data = [
            'url' => 'data:image/png;base64,' . $this->requestModel->imageContent,
            'name' => $this->requestModel->name,
            'tags' => $this->extractTags($this->requestModel->tags),
            'gallery' => $this->extractGallery($this->requestModel->tags)
        ];

        $photo = new Photo($data);
        $this->storage->store($photo);
        $this->repository->store($photo);

        return $photo;
    }

    /**
     * @param array $tags
     * @return array
     */
    private function extractTags(array $tags)
    {
        $tagNames = [];
        foreach ($tags as $tag) {
            if (!preg_match('/Gallery:/', $tag)) {
                $tagNames[] = ['name' => $tag];
            }
        }

        return $tagNames;
    }

    /**
     * @param array $tags
     * @return string
     */
    private function extractGallery(array $tags)
    {
        foreach ($tags as $tag) {
            if (preg_match('/Gallery:/', $tag)) {
                return ['name' => str_replace('Gallery:', '', $tag)];
            }
        }
    }
}
