<?php
/*
 * This file is part of the gallery package.
 * (c) Michal Giergielewicz <michal@giergielewicz.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Freyr\Gallery\Core\Interactor;

use Freyr\Gallery\Core\RequestModel;

/**
 * Class AbstractInteractor
 * @package Freyr\Gallery\Core\Interactor
 */
class AbstractInteractor
{

    /**
     * @var RequestModel
     */
    protected $requestModel = null;

    /**
     * @param RequestModel $requestModel
     */
    public function setRequestModel(RequestModel $requestModel)
    {
        $this->requestModel = $requestModel;
    }

    public function execute()
    {
        if ($this->isRequestSet() === false) {
            // TODO: Add exception
            throw new \Exception();
        }
    }

    /**
     * @return bool
     */
    protected function isRequestSet()
    {
        return is_null($this->requestModel) ? false : true;
    }
}
