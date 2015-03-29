<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 22:31
 */

namespace Freyr\Gallery\Core\RequestModel;

use Freyr\Gallery\Core\RequestModel;

/**
 * Class PhotoRequestModel
 * @package Freyr\Gallery\Core\RequestModel
 */
class PhotoRequestModel implements RequestModel
{

    /**
     * @var string
     */
    public $photoId = null;
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
    /**
     * @var string
     */
    public $imageMime = '';
}