<?php
/*
 * This file is part of the Gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Freyr\Gallery\WebBundle\Command;

use Freyr\Gallery\Core\Interactor\Photos\CreatePhotoFromFile;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ApiImportPhotosFromFolderCommand
 * @package Freyr\Gallery\WebBundle\Command
 */
class ApiImportPhotosFromFolderCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('import:api:folder')
            ->setDescription('Import photos from selected folder through API')
            ->addArgument(
                'dir',
                InputArgument::REQUIRED,
                'Specify folder to import from?'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $dir = $input->getArgument('dir');
        $files = $this->parseDir($dir);

        $output->writeln('BEGIN');

        foreach ($files as $file) {
            if (!$this->isImage($file)) {
                continue;
            }

            $output->writeln($file);

            $data = $this->parseImage($file);
            $response = $this->sendImage($data);

            $output->writeln($response);
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

    /**
     * @param string $file
     * @return array
     */
    private function parseImage($file)
    {
        return [
            'lightroomTags' => $this->extractLightroomTags($file),
            'mime' => $this->getMime($file),
            'base64' => base64_encode(file_get_contents($file)),
            'name' => basename($file),
        ];
    }

    /**
     * @param string $url
     * @return array
     * TODO: make trait for this functionality
     */
    private function extractLightroomTags($url)
    {
        $tags = [];
        getimagesize($url, $info);
        if (isset($info['APP13'])) {
            $iptc = iptcparse($info['APP13']);
            /** @noinspection PhpParamsInspection */
            if (count($iptc["2#025"] > 0)) {
                foreach ($iptc["2#025"] as $tagName) {
                    $tags[] = $tagName;
                }
            }
        }
        return $tags;
    }

    /**
     * @param string $file
     * @return string
     */
    private function getMime($file)
    {
        return image_type_to_mime_type(exif_imagetype($file));
    }

    /**
     * @param array $data
     * @return string
     */
    private function sendImage($data)
    {
        $data = json_encode($data);
        $ch = curl_init('http://gallery.freyr.dev/api/photo');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);

        return curl_exec($ch);
    }
}