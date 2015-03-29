<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-29
 * Time: 21:33
 */

namespace Freyr\Gallery\Tests\Core\Interactor\Photos;

use Freyr\Gallery\Core\Entity\Tag;
use Freyr\Gallery\Core\Interactor\Photos\GetPhotosByTags;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Tests\Core\PhotoTestCase;

/**
 * Class GetPhotosByTagsTest
 * @package Freyr\Gallery\Tests\Core\Interactor\Photos
 */
class GetPhotosByTagsTest extends PhotoTestCase
{

    public function testInitialise()
    {
        $this->loadFixture(100, ['One', 'Two', 'three'], ['uno', 'duo', 'single', 'double', 'triple', 'octo']);
        $interactor = new GetPhotosByTags($this->repository);
        $requestModel = new PhotoRequestModel();

        $tags = [];
        $tags[] = new Tag(['name' => 'uno']);
        $requestModel->tags = $tags;
        $interactor->setRequestModel($requestModel);
        $result = $interactor->execute();
        $this->assertNotEmpty($result);

        $tags = [];
        $tags[] = new Tag(['name' => 'ta']);
        $requestModel->tags = $tags;
        $interactor->setRequestModel($requestModel);
        $result = $interactor->execute();
        $this->assertEmpty($result);
    }

}