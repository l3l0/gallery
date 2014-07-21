<?php
namespace Freyr\GalleryCore\Entity;

/**
 * Interface Image
 * @package Freyr\GalleryCore\Entity
 */
interface Image {

    /**
     * @param Keyword $category
     */
    public function setCategory(Keyword $category);

    /**
     * @return Keyword
     */
    public function getCategory();

    /**
     * @param Keyword[] $keywords
     */
    public function setCurrentKeyword(array $keywords);

    /**
     * @return Keyword
     */
    public function getCurrentKeyword();

    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $imageId
     */
    public function setId($imageId);

    /**
     * @param string $imageName
     */
    public function setName($imageName);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return Keyword[]
     */
    public function getKeywords();

    /**
     * @param Keyword[] $keywords
     */
    public function setKeywords(array $keywords);

    /**
     * @param Keyword $keyword
     */
    public function addKeyword(Keyword $keyword);

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $exposureTime
     */
    public function setExposureTime($exposureTime);

    /**
     * @return string
     */
    public function getExposureTime();

    /**
     * @param string $fNumber
     */
    public function setFNumber($fNumber);

    /**
     * @return string
     */
    public function getFNumber();

    /**
     * @param string $focalLength
     */
    public function setFocalLength($focalLength);

    /**
     * @return string
     */
    public function getFocalLength();

    /**
     * @param string $importPath
     */
    public function setImportPath($importPath);

    /**
     * @return string
     */
    public function getImportPath();

    /**
     * @param string $iso
     */
    public function setIso($iso);

    /**
     * @return string
     */
    public function getIso();
}