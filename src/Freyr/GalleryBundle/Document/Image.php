<?php
namespace Freyr\GalleryBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Image
 * @package Freyr\GalleryBundle\Document
 * @MongoDB\Document(repositoryClass="Freyr\GalleryBundle\Repository\ImageRepository")
 */
class Image {

    /**
     * @MongoDB\Id
     * @var string
     */
    private $id;

    /**
     * @MongoDB\String
     * @var string
     */
    private $keyword;

    /**
     * @MongoDB\String
     * @var string
     */
    private $internalUrl;

    /**
     * @MongoDB\String
     * @var string
     */
    private $importPath;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $importPath
     */
    public function setImportPath($importPath)
    {
        $this->importPath = $importPath;
    }

    /**
     * @return string
     */
    public function getImportPath()
    {
        return $this->importPath;
    }

    /**
     * @param string $internalUrl
     */
    public function setInternalUrl($internalUrl)
    {
        $this->internalUrl = $internalUrl;
    }

    /**
     * @return string
     */
    public function getInternalUrl()
    {
        return $this->internalUrl;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}