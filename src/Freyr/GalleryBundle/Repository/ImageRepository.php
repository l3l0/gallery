<?php
namespace Freyr\GalleryBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Freyr\GalleryBundle\Document\Image;
use Freyr\LightroomParser\Core\Image as CoreImage;

class ImageRepository extends DocumentRepository {


    public function findAllByKeyword($keyword)
    {
        return $this->findBy(["keyword" => $keyword],["takenAt" => "DESC"]);
    }

    /**
     * @param $keyword
     * @param $imageId
     * @return Image[]
     */
    public function findOneByKeywordAndId($keyword, $imageId)
    {
        return $this->findBy(["keyword" => $keyword, "id" => $imageId],["takenAt" => "DESC"]);
    }

    public function dispatchImageForAlbums(CoreImage $image)
    {
        foreach ($image->getKeywords() as $keyword)
        {
            $bundleImage = new Image();
            $bundleImage->setImportPath($image->getImportPath());
            $bundleImage->setKeyword($keyword);
            $this->addImage($bundleImage);
        }
    }

    public function addImage(Image $image)
    {

    }
}