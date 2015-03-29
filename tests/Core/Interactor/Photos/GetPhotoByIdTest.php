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
        $interactor = new GetPhotoById($this->repository);

        $requestModel = new PhotoRequestModel();
        $requestModel->photoId = $photo->getId();

        $interactor->setRequestModel($requestModel);
        $fetchedPhoto = $interactor->execute();

        $this->assertEquals($photo->getId(), $fetchedPhoto->getId());
        $this->assertEquals($photo->getName(), $fetchedPhoto->getName());
        $this->assertEquals($photo->getGallery()->getName(), $fetchedPhoto->getGallery()->getName());

    }

    /**
     * @expectedException \Exception
     */
    public function getNonExistingPhoto()
    {
        $interactor = new GetPhotoById($this->repository);

        $requestModel = new PhotoRequestModel();
        $requestModel->photoId = 1;

        $interactor->setRequestModel($requestModel);
        $interactor->execute();
    }
}