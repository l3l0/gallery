<?php

namespace Freyr\Gallery\Core\RequestModel;

use Freyr\Gallery\Core\RequestModel;

/**
 * Class ImageRequestModel
 * @package Freyr\Gallery\Core\RequestModel
 */
class ImageRequestModel
{

    public $id = null;
    /**
     * @var string
     */
    public $cloudId = null;
    /**
     * @var string
     */
    public $url = '';
    /**
     * @var string
     */
    public $name = '';
    /**
     * @var array
     */
    public $tags = [];
}
