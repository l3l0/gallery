<?php
namespace Freyr\GalleryCore\Service;

use Freyr\GalleryCore\Entity\Keyword;

/**
 * Class KeywordFactory
 * @package Freyr\GalleryCore\Service
 */
class KeywordFactory {

    /**
     * @var string
     */
    private $keywordClass;

    /**
     * @param $keywordClass
     */
    public function __construct($keywordClass)
    {
        $this->keywordClass = $keywordClass;
    }

    /**
     * @param $keywordName
     * @return Keyword
     */
    public function create($keywordName)
    {
        return new $this->keywordClass($keywordName);
    }
}
