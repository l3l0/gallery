<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Gallery;

/**
 * Class GetPhotosFromGalleryResponseModel
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class GetPhotosFromGalleryResponseModel
{

    public $name = '';
    public $photoUrl = '';

    /**
     * @param Gallery $gallery
     */
    public function __construct(Gallery $gallery)
    {
        $this->name = $gallery->getName();
        $this->photoUrl = $gallery->getCoverPhoto()->getUrl();

        unset($gallery);
    }
}
