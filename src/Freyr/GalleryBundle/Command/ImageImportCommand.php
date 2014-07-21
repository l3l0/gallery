<?php
namespace Freyr\GalleryBundle\Command;

use Cloudinary\Uploader;
use Freyr\GalleryBundle\Document\LightroomImage;
use Freyr\GalleryBundle\Document\LightroomKeyword;
use Freyr\LightroomParser\Core\Image as CoreImage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImageImportCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this->setName('freyr:gallery:import')
            ->setDescription('Imports images from folder into system');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump(getenv('CLOUDINARY_URL'));
        var_dump($this->getContainer()->getParameter('mongohq.url'));

        $parser = $this->getContainer()->get('freyr.parser');
        $parsedImages = $parser->parse();
        $imageRepository = $this->getContainer()->get('freyr.gallery.repository.image');

        foreach ($parsedImages->getImages() as $parsedImage) {
            $image = $this->createImageFromParsedData($parsedImage);
            $imageRepository->save($image);
        }
    }

    /**
     * @param CoreImage $coreImage
     * @return Image
     */
    private function createImageFromParsedData(CoreImage $coreImage)
    {
        $image = new LightroomImage();
        $result = Uploader::upload($coreImage->getImportPath());
        $image->setCloudinaryId($result['public_id']);
        $image->setImportPath($coreImage->getImportPath());
        $image->setCreatedAt($coreImage->getCreatedAt());
        $image->setExposureTime($coreImage->getExposureTime());
        $image->setFNumber($coreImage->getFNumber());
        $image->setFocalLength($coreImage->getFocalLength());
        $image->setIso($coreImage->getIso());

        foreach ($coreImage->getKeywords() as $keyword)
        {
            $image->addKeyword(new LightroomKeyword($keyword));
        }

        return $image;
    }

}