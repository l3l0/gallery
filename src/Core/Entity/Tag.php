<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Entity;

/**
 * Class Tag
 * @package Freyr\Gallery\Core\Entity
 */
class Tag
{

    private $name;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $this->sanitizeName($data['name']);
    }

    /**
     * @param $name
     * @return string
     */
    private function sanitizeName($name)
    {
        return strtolower(str_replace(' ', '-', trim($name)));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
