<?php
/**
 * Created by IntelliJ IDEA.
 * User: michal
 * Date: 2015-03-31
 * Time: 20:55
 */

namespace Freyr\Gallery\Core\Interactor\Photos;

use Freyr\Gallery\Core\Exception\PhotoCreationException;
use Freyr\Gallery\Core\Interactor\AbstractInteractor;

/**
 * Class PhotoInteractor
 * @package Freyr\Gallery\Core\Interactor\Photos
 */
class PhotoInteractor extends AbstractInteractor
{

    /**
     * @param array $lightroomTags
     * @return array
     */
    protected function prepareTags($lightroomTags)
    {
        $tags = [];
        foreach ($lightroomTags as $tagName) {
            if (!preg_match('/Gallery:/', $tagName)) {
                $tags[] = ['name' => $tagName];
            }
        }

        return $tags;
    }

    /**
     * @param array $lightroomTags
     * @return array
     * @throws \Exception
     */
    protected function prepareGallery($lightroomTags)
    {
        foreach ($lightroomTags as $tagName) {
            if (preg_match('/Gallery:/', $tagName)) {
                return ['name' => str_replace('Gallery:', '', $tagName)];
            }
        }

        throw new PhotoCreationException('Bad structure', 2);
    }

}