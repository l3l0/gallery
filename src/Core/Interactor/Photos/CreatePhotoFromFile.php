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
     * @param PhotoRepositoryInterface $repository
     * @param PhotoStorageInterface $storage
     */
    public function __construct(PhotoRepositoryInterface $repository, PhotoStorageInterface $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
    }

    /**
     * @return Photo
     * @throws \Exception
     */
    public function execute()
    {
        parent::execute();
        $data = [
            'url' => $this->requestModel->url,
            'name' => $this->requestModel->name,
            'tags' => $this->extractTags($this->requestModel->url),
        ];

        $photo = new Photo($data);
        $this->storage->store($photo);
        $this->repository->store($photo);

        return $photo;
    }

    /**
     * @param string $url
     * @return array
     */
    private function extractTags($url)
    {
        $tags = [];
        getimagesize($url, $info);
        if (isset($info['APP13'])) {
            $iptc = iptcparse($info['APP13']);
            /** @noinspection PhpParamsInspection */
            if (count($iptc["2#025"] > 0)) {
                foreach ($iptc["2#025"] as $tagName) {
                    $tags[] = ['name' => $tagName];
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
