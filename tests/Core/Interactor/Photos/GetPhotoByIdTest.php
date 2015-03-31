<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 21:58
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;


use Freyr\Gallery\Core\Entity\Photo;
use Freyr\Gallery\Core\Interactor\Photos\GetPhotoById;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoByIdTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotoByIdTest extends PhotoTestCase
{


    public function testGetExistingPhoto()
    {
        $data = $this->generateRandomPhotoData();
        $photo = new Photo($data);
        $photo = $this->repository->store($photo);
        $interactor = new GetPhotoById($photo->getId(), $this->repository);
        $fetchedPhoto = $interactor->execute();

        $this->assertEquals($photo->getId(), $fetchedPhoto['id']);
        $this->assertEquals($photo->getName(), $fetchedPhoto['name']);
        $this->assertEquals($photo->getGallery()->getName(), $fetchedPhoto['gallery']['name']);

    }

    /**
     * @expectedException \Exception
     */
    public function getNonExistingPhoto()
    {
        $interactor = new GetPhotoById(1, $this->repository);
        $interactor->execute();
    }
}