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
 * Class CreatePhotoFromRawData
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class CreatePhotoFromFile extends PhotoInteractor implements CommandInterface
{

    /**
     * @var PhotoStorageInterface
     */
    private $storage;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct($path, PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
        $this->path = $path;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function execute()
    {
        $lightroomTags = $this->extractLightroomTags($this->path);
        $tags = $this->prepareTags($lightroomTags);
        $gallery = $this->prepareGallery($lightroomTags);

        $data = [
            'url' => $this->path,
            'name' => $this->path, //TODO: extract name from path
            'tags' => $tags,
            'gallery' => $gallery
        ];

        $photo = new Photo($data);
        $result = $this->storage->store($photo);
        $photo->setId($result['public_id']);
        $this->repository->store($photo);

        return $photo->asDataStructure();
    }

    /**
     * @param string $url
     * @return array
     */
    private function extractLightroomTags($url)
    {
        $tags = [];
        getimagesize($url, $info);
        if (isset($info['APP13'])) {
            $iptc = iptcparse($info['APP13']);
            /** @noinspection PhpParamsInspection */
            if (count($iptc["2#025"] > 0)) {
                foreach ($iptc["2#025"] as $tagName) {
                    $tags[] = $tagName;
                }
            }
        }
        return $tags;
    }

    /**
     * Fetching meta data
     * @param string $url
     * @return \stdClass
     */
    private function retrieveMeta($url)
    {
        $data = exif_read_data($url, 'EXIF', true);
        $data = $data['EXIF'];

        $meta = new \stdClass();
        $meta->exposureTime = (isset($data['ExposureTime']) ? $data['ExposureTime'] : null);
        $meta->fNumber = (isset($data['FNumber']) ? $data['FNumber'] : null);
        $meta->iso = (isset($data['ISOSpeedRatings']) ? $data['ISOSpeedRatings'] : null);
        $meta->createdAt = (isset($data['DateTimeOriginal']) ? $data['DateTimeOriginal'] : null);
        $meta->focalLength = (isset($data['FocalLength']) ? $data['FocalLength'] : null);

        return $meta;
    }
}
