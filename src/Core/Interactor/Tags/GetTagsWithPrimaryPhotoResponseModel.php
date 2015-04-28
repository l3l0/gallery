<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Tags;

use Freyr\Gallery\Core\Entity\Tag;

/**
 * Class GetTagsWithPrimaryPhotoResponseModel
 * @package Freyr\Gallery\Core\Interactor\Galleries
 */
class GetTagsWithPrimaryPhotoResponseModel
{

    public $name = '';
    public $photoUrl = '';

    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->name = $tag->getName();
        $this->photoUrl = $tag->getCoverPhoto()->getUrl();

        unset($tag);
    }
}
