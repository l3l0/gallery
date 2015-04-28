<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\WebBundle\Repository;

use Freyr\Gallery\WebBundle\Repository\MongoDBPhotoRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class MongoDBPhotoRepositoryTest
 * @package Freyr\Gallery\Tests\WebBundle
 */
class MongoDBPhotoRepositoryTest extends WebTestCase
{

    /**
     * @var MongoDBPhotoRepository
     */
    private $repository;

    public function testStore()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $this->repository = $container->get('freyr.gallery.repository.photo');
        $photo = $this->generatePhoto();

        $this->repository->store($photo);
    }
}
