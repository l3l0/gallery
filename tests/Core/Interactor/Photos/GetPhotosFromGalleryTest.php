<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 21:25
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Interactor\Photos\GetPhotosFromGallery;
use Freyr\Gallery\Core\RequestModel\GalleryRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotoFromGalleryTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotosFromGalleryTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $this->loadFixture(100, ['One', 'Two', 'three'], ['uno', 'duo', 'single', 'double', 'triple', 'octo']);

        $requestModel = new GalleryRequestModel();
        $requestModel->name = 'one';
        $interactor = new GetPhotosFromGallery($requestModel, $this->repository);
        $galleries = $interactor->execute();
        $this->assertNotEmpty($galleries);
    }
}