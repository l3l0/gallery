<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-28
 * Time: 22:16
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Galleries;


use Freyr\Gallery\Core\Interactor\Galleries\GetGalleries;
use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromBase64;
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
            $requestModel = $this->generateBase64PhotoData();
            $createInteractor = new CreatePhotoFromBase64($requestModel, $this->repository, $this->storage);
            $createInteractor->execute();
        }
    }

    public function testGetAllGalleries()
    {
        $interactor = new GetGalleries($this->repository);
        $galleries = $interactor->execute();

        foreach ($galleries as $gallery) {
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\Gallery', $gallery);
            $this->assertInstanceOf('Freyr\Gallery\Core\Entity\CoverPhoto', $gallery->getCoverPhoto());
        }
    }
}