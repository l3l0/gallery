<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Interactor\Tags;

use Freyr\Gallery\Core\Interactor\Tags\GetTags;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetTagTest
 * @package Freyr\Gallery\Tests\Core\Entity
 */
class GetTagTest extends PhotoTestCase
{

    /**
     *
     */
    public function testInitialise()
    {
        $this->loadFixture(100, ['uno', 'duo', 'three', 'tag test', 'luzik']);
        $interactor = new GetTags($this->repository);
        $interactor->execute();
    }
}
