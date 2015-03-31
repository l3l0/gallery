<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-31
 * Time: 20:22
 */

namespace Freyr\Gallery\Core\Entity;

/**
 * Class CoverPhoto
 * @package Freyr\Gallery\Core\Entity
 */
class CoverPhoto
{

    /**
     * @var Photo
     */
    private $photo;

    /**
     * @param Photo $photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return array
     */
    public function asDataStructure()
    {
        return [
            'name' => $this->getName(),
            'cloudId' => $this->getCloudId()
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->photo->getName();
    }

    /**
     * @return string
     */
    public function getCloudId()
    {
        return $this->photo->getCloudId();
    }
}