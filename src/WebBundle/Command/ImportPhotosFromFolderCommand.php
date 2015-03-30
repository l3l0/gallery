<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-30
 * Time: 22:49
 */

namespace Freyr\Gallery\WebBundle\Command;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromFile;
use Freyr\Gallery\Core\Repository\MemoryPhotoRepository;
use Freyr\Gallery\Core\RequestModel\PhotoRequestModel;
use Freyr\Gallery\Core\Storage\MemoryPhotoStorage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportPhotosFromFolderCommand
 * @package Freyr\Gallery\WebBundle\Command
 */
class ImportPhotosFromFolderCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('import:folder')
            ->setDescription('Import photos from selected folder')
            ->addArgument(
                'dir',
                InputArgument::REQUIRED,
                'Specify folder to import from?'
            );

        // TODO: only for develop - check export url
        \Cloudinary::config(array(
            "cloud_name" => "hanrcocaq",
            "api_key" => "675759441666922",
            "api_secret" => "ByL-uFf9vzrfmcDCbnxFplQ47JY"
        ));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this->getContainer()->get('freyr.gallery.repository.photo');
//        $repository = new MemoryPhotoRepository();
        $storage = $this->getContainer()->get('freyr.gallery.storage.photo');
//        $storage = new MemoryPhotoStorage();

        $dir = $input->getArgument('dir');
        $files = $this->parseDir($dir);

        $output->writeln('BEGIN');

        foreach ($files as $file) {
            if (!$this->isImage($file)) {
                continue;
            }

            $output->writeln($file);
            $requestModel = new PhotoRequestModel();
            $requestModel->url = $file;
            $requestModel->name = uniqid('name');
            $interactor = new CreatePhotoFromFile($requestModel, $repository, $storage);
            $photo = $interactor->execute();
            $output->writeln($photo->cloudId . ' - ' . $photo->id);
        }

        $output->writeln('END');

    }

    /**
     * @param string $dir
     * @return array
     */
    private function parseDir($dir)
    {
        // @TODO filter dir name to ensure that it doesn't contain trailing slash
        $list = scandir($dir);
        $result = [];
        foreach ($list as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $result[] = $dir . '/' . $item;
        }
        return $result;
    }

    /**
     * @param string $fileAbsolutePath
     * @return bool
     */
    private function isImage($fileAbsolutePath)
    {
        $allowedExtension = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($fileAbsolutePath, PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $allowedExtension)) {
            return false;
        }
        $allowedTypes = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF];
        $detectedType = exif_imagetype($fileAbsolutePath);
        return in_array($detectedType, $allowedTypes);
    }

}