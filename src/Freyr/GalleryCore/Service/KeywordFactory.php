<?php
namespace Freyr\GalleryCore\Service;

/**
 * Class KeywordFactory
 * @package Freyr\GalleryBundle\Service
 */
class KeywordFactory {

    private $keywordClass;

    public function __construct($keywordClass)
    {
        $this->keyword = $keywordClass;
    }

    public function create($keywordName)
    {
        return new $this->keywordClass($keywordName);
    }
}