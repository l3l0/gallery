<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 21:58
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;


use Freyr\Gallery\Core\Interactor\Photos\GetPhotoById;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoByIdTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotoByIdTest extends PhotoTestCase
{


    public function testGetExistingPhoto()
    {
        $photo = $this->addRandomPhoto();
        $requestModel = new PhotoRequestModel();
        $requestModel->photoId = $photo->getId();

        $interactor = new GetPhotoById($requestModel, $this->repository);
        $fetchedPhoto = $interactor->execute();

        $this->assertEquals($photo->getId(), $fetchedPhoto->photoId);
        $this->assertEquals($photo->getName(), $fetchedPhoto->name);
        $this->assertEquals($photo->getGallery()->getName(), $fetchedPhoto->gallery);

    }

    /**
     * @expectedException \Exception
     */
    public function getNonExistingPhoto()
    {
        $requestModel = new PhotoRequestModel();
        $requestModel->photoId = 1;

        $interactor = new GetPhotoById($requestModel, $this->repository);
        $interactor->execute();
    }
}