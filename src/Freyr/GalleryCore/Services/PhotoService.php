<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\GalleryCore\Services;

use Freyr\GalleryCore\Wrappers\PhotoWrapper;

/**
 * Class SinglePhoto
 * @package Freyr\GalleryCore\Services
 */
class PhotoService {

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(PhotoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPhotoByKeywordAndId($keyword, $photoId)
    {
        $rawData = $this->repository->getByKeywordAndId($keyword, $photoId);
        return PhotoWrapper::transferCoreToBundleObject($rawData);
    }
} 
