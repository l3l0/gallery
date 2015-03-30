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
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Core\ResponseModel\PhotoResponseModel;
use Freyr\Gallery\Core\Storage\PhotoStorageInterface;

/**
 * Class CreatePhotoFromRawData
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class CreatePhotoFromFile extends AbstractInteractor implements CommandInterface
{

    /**
     * @var PhotoRequestModel
     */
    protected $requestModel;
    /**
     * @var PhotoStorageInterface
     */
    private $storage;
    /**
     * @var PhotoRepositoryInterface
     */
    private $repository;

    /**
     * @param PhotoRequestModel $requestModel
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct(PhotoRequestModel $requestModel, PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
        $this->requestModel = $requestModel;
    }

    /**
     * @return PhotoResponseModel
     * @throws \Exception
     */
    public function execute()
    {
        $lightroomTags = $this->extractLightroomTags($this->requestModel->url);
        $tags = $this->prepareTags($lightroomTags);
        $gallery = $this->prepareGallery($lightroomTags);

        $data = [
            'url' => $this->requestModel->url,
            'name' => $this->requestModel->name,
            'tags' => $tags,
            'gallery' => $gallery
        ];

        $photo = new Photo($data);
        $this->storage->store($photo);
        $this->repository->store($photo);

        return $photo->toResponseModel();
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
     * @param array $lightroomTags
     * @return array
     */
    private function prepareTags($lightroomTags)
    {
        $tags = [];
        foreach ($lightroomTags as $tagName) {
            if (!preg_match('/Gallery:/', $tagName)) {
                $tags[] = ['name' => $tagName];
            }
        }

        return $tags;
    }

    /**
     * @param array $lightroomTags
     * @return array
     */
    private function prepareGallery($lightroomTags)
    {
        foreach ($lightroomTags as $tagName) {
            if (preg_match('/Gallery:/', $tagName)) {
                return ['name' => str_replace('Gallery:', '', $tagName)];
            }
        }
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
