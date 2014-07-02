<?php

namespace Freyr\GalleryCore\Repository;

/**
 * Interface PhotoRepositoryInterface
 * @package Freyr\GalleryCore\Repository
 */
interface PhotoRepositoryInterface {

    /**
     * Gets one photo that meet criteria (keyword and photo id)
     * @param string $keyword
     * @param string $photoId
     * @return mixed
     */
    public function getByKeywordAndId($keyword, $photoId);
} 
