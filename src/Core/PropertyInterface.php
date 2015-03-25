<?php
namespace Freyr\Gallery\Core;

/**
 * Interface PropertyInterface
 * @package Freyr\Gallery\Core
 * TODO: make it more generic, independent from cloudinary, just raw image properties that are used
 */
interface PropertyInterface
{

    /**
     * @param array $propertyRawData
     */
    public function __construct(array $propertyRawData);

    /**
     * @return mixed
     */
    public function getPublicId();

    /**
     * @return mixed
     */
    public function getWidth();

    /**
     * @return mixed
     */
    public function getHeight();

    /**
     * @return mixed
     */
    public function getFormat();

    /**
     * @return mixed
     */
    public function getResourceType();

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @return mixed
     */
    public function getUrl();

    /**
     * @return mixed
     */
    public function getSecureUrl();
}
