<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 22:16
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Galleries;


use Freyr\Gallery\Core\Interactor\Galleries\GetGalleriesWithPrimaryPhoto;
use Freyr\Gallery\Core\Interactor\Photos\AddImageAsPhotoInteractor;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetGalleriesTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Galleries
 */
class GetGalleriesTest extends PhotoTestCase
{

    public function setUp()
    {
        parent::setUp();
        for ($i = 1; $i <= 10; $i++) {
            $requestModel = $this->generatePhotoRequestModel();
            $createInteractor = new AddImageAsPhotoInteractor($requestModel, $this->repository, $this->storage);
            $createInteractor->execute();
        }
    }

    public function testGetAllGalleries()
    {
        $interactor = new GetGalleriesWithPrimaryPhoto($this->repository);
        $galleries = $interactor->execute();

        foreach ($galleries as $gallery) {
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Gallery', $gallery);
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Photo', $gallery->getCoverPhoto());
        }
    }
}
