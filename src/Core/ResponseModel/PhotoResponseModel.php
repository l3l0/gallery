<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 22:43
 */

namespace Freyr\Gallery\Core\ResponseModel;

use Freyr\Gallery\Core\ResponseModel;

/**
 * Class PhotoResponseModel
 * @package Freyr\Gallery\Core\ResponseModel
 */
class PhotoResponseModel implements ResponseModel
{

    /**
     * @var string
     */
    public $id = '';
    /**
     * @var string
     */
    public $cloudId = '';
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
    public $gallery;
}