<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Photos;

/**
 * Class GetPhotoDTO
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class GetPhotoDTO
{

    /**
     * @var string
     */
    public $id;
    /**
     * @var array;
     */
    public $tags;
    /**
     * @var string
     */
    public $smallUrl;
    /**
     * @var string
     */
    public $standardUrl;
}
