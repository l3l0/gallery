<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Tests\Core\Repository;

use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class AddImageAsPhotoTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class MemoryPhotoRepositoryTest extends PhotoTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testStorePhoto()
    {
        $photo = $this->getSamplePhoto();
        $this->repository->store($photo);
        $this->assertNotEmpty($this->repository->findById($photo->getId()));
    }

    public function testFindByExistingId()
    {
        $photo = $this->getSamplePhoto();
        $this->repository->store($photo);
        $this->assertEquals($photo, $this->repository->findById($photo->getId()));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFindByNotExistingId()
    {
        $this->repository->findById('121212121');
    }

    public function testFindPhotosByTags()
    {
        $this->loadFixture(100, ['uno', 'duo', 'three', 'tag test', 'luzik']);
        $photos = $this->repository->findPhotosByTags(['uno', 'duo']);
        foreach ($photos as $photo) {
            $intersect = array_intersect($photo->getTagsAsArray(), ['uno', 'duo']);
            $this->assertCount(2, $intersect);
            $expected = array_values(['uno', 'duo']);
            $actual = array_values($intersect);
            $this->assertEquals(sort($expected), sort($actual));
        }
    }

    public function findAllTags()
    {
        $this->loadFixture(100, ['uno', 'duo', 'three', 'tag test', 'luzik']);
        $tags = $this->repository->findAllTags();
        $this->assertCount(5, $tags);
        foreach ($tags as $tag) {
            $this->assertInstanceOf('\Freyr\Gallery\Core\Entity\Tag', $tag);
        }
    }
}
