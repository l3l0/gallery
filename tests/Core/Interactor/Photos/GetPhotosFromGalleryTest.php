<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 21:25
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Gallery;
use Freyr\Gallery\Core\Interactor\Photos\GetPhotosFromGallery;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoFromGalleryTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotosFromGalleryTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $interactor = new GetPhotosFromGallery($this->repository);
        $gallery = new Gallery(['name' => 'GalleryOne']);
        $requestModel = new PhotoRequestModel();
        $requestModel->gallery = $gallery;
        $interactor->setRequestModel($requestModel);
        $interactor->execute();
    }
}