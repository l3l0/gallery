<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\Core\Interactor;

/**
 * Interface CommandInterface
 * @package Freyr\Gallery\Core\Interactor
 */
interface CommandInterface
{

    /**
     * @return array
     */
    public function execute();
}
