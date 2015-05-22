<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Tests;

use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Entity\Tag;

/**
 * Class BaseTestCase
 * @package Freyr\Tests
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Generates random tag object
     * @param int $howMany
     * @return Tag
     */
    protected function generateTag($howMany = 1)
    {
        $tags = [];
        for ($i = 1; $i <= $howMany; $i++) {
            $data = [
                'name' => uniqid(),
            ];
            $tags[] = new Tag($data);
        }

        return $tags;
    }

    /**
     * Generates random tag object
     * @return Photo
     */
    protected function generatePhoto()
    {
        $data = [
            'name' => uniqid(),
            'url' => 'none',
            'tags' => [
                ['name' => uniqid()],
                ['name' => uniqid()],
                ['name' => uniqid()]
            ],
            'gallery' => ['name' => uniqid()]
        ];
        return new Photo($data);
    }
}
