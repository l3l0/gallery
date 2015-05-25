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
 * Class PhotoNotFoundException
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class PhotoNotFoundException extends PhotoInteractorException
{

    /**
     * @param string $photoId
     * @param \Exception $exception
     */
    public function __construct($photoId, \Exception $exception = null)
    {
        parent::__construct('Photo with ID: ' . $photoId . ', was not found', 1, $exception);
    }
}
