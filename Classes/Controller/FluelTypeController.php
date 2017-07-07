<?php
namespace Vehicle\Cars\Controller;

/***
 *
 * This file is part of the "Cars" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017
 *
 ***/

/**
 * FluelTypeController
 */
class FluelTypeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * fluelTypeRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\FluelTypeRepository
     * @inject
     */
    protected $fluelTypeRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $fluelTypes = $this->fluelTypeRepository->findAll();
        $this->view->assign('fluelTypes', $fluelTypes);
    }
}
