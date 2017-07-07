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
 * CompanyController
 */
class CompanyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * companyRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\CompanyRepository
     * @inject
     */
    protected $companyRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $companies = $this->companyRepository->findAll();
        $this->view->assign('companies', $companies);
    }
}
