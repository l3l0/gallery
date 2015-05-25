<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor\Tags;

use Freyr\Gallery\Core\Entity\TagResponse;

/**
 * Class GetTagsResponse
 * @package Freyr\Gallery\Core\Interactor\Tags
 */
class GetTagsResponse
{

    /**
     * @var TagResponse[]
     */
    public $tags = [];

    /**
     * @return array
     */
    public function asArray()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->name;
        }

        return $tags;
    }
}
