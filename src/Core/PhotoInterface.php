<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core;

/**
 * Interface PhotoInterface
 * @package Freyr\Gallery\Core
 */
interface PhotoInterface
{

    /**
     * @return GalleryInterface
     */
    public function getGallery();

    /**
     * @param GalleryInterface $gallery
     */
    public function setGallery(GalleryInterface $gallery);

    /**
     * @return PropertyInterface
     */
    public function getProperty();

    /**
     * @param PropertyInterface $property
     */
    public function setProperty($property);

    /**
     * @return TagInterface
     */
    public function getCurrentTag();

    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $photoId
     */
    public function setId($photoId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $photoName
     */
    public function setName($photoName);

    /**
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * @param TagInterface[] $tags
     */
    public function setTags(array $tags);

    /**
     * @param TagInterface $tag
     */
    public function addTag(TagInterface $tag);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getExposureTime();

    /**
     * @param string $exposureTime
     */
    public function setExposureTime($exposureTime);

    /**
     * @return string
     */
    public function getFNumber();

    /**
     * @param string $fNumber
     */
    public function setFNumber($fNumber);

    /**
     * @return string
     */
    public function getFocalLength();

    /**
     * @param string $focalLength
     */
    public function setFocalLength($focalLength);

    /**
     * @return string
     */
    public function getIso();

    /**
     * @param string $iso
     */
    public function setIso($iso);
}
