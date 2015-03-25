<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Freyr\Gallery\Core\PhotoInterface;
use Freyr\Gallery\Core\TagInterface;

/**
 * Class Tag
 * @package Freyr\Gallery\WebBundle\Document
 * @MongoDB\EmbeddedDocument
 */
class Tag implements TagInterface
{

    /**
     * @MongoDB\String
     * @var string
     */
    private $name;

    /**
     * @var PhotoInterface
     */
    private $primaryPhoto;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = strtolower(str_replace(' ', '-', $name));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return PhotoInterface
     */
    public function getPrimaryPhoto()
    {
        return $this->primaryPhoto;
    }

    /**
     * @param PhotoInterface $primaryPhoto
     */
    public function setPrimaryPhoto(PhotoInterface $primaryPhoto)
    {
        $this->primaryPhoto = $primaryPhoto;
    }
}
