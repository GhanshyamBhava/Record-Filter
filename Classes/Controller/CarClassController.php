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
 * CarClassController
 */
class CarClassController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * carClassRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\CarClassRepository
     * @inject
     */
    protected $carClassRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $carClasses = $this->carClassRepository->findAll();
        $this->view->assign('carClasses', $carClasses);
    }
}
