<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Photo;

/**
 * Class GetPhotosFromGalleryResponseModel
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class AddImageAsPhotoResponseModel
{

    public $id;
    public $name;
    public $url;
    public $cloudId;

    /**
     * @param Photo $photo
     */
    public function __construct(Photo $photo)
    {
        $this->id = $photo->getId();
        $this->name = $photo->getName();
        $this->url = $photo->getUrl();
        $this->cloudId = $photo->getCloudId();

        unset($photo);
    }
}
