<?php
namespace Vehicle\Cars\Controller;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
 * CarsController
 */
class CarsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * carsRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\CarsRepository
     * @inject
     */
    protected $carsRepository = null;

    /**
     * companyRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\CompanyRepository
     * @inject
     */
    protected $companyRepository = null;

    /**
     * fluelTypeRepository
     *
     * @var \Vehicle\Cars\Domain\Repository\FluelTypeRepository
     * @inject
     */
    protected $fluelTypeRepository = null;

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
        $companies = $this->companyRepository->findAll();
        $this->view->assign('company', $companies);

        $fluelTypes = $this->fluelTypeRepository->findAll();
        $this->view->assign('fluelTypes', $fluelTypes);

        $fluelTypes = $this->carClassRepository->findAll();
        $this->view->assign('carClass', $fluelTypes);

        $cars = $this->carsRepository->findAll('tx_cars_domain_model_cars');
        $this->view->assign('cars', $cars);
    }

    /**
     * action show
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $cars
     * @return void
     */
    public function showAction(\Vehicle\Cars\Domain\Model\Cars $cars)
    {
        $this->view->assign('cars', $cars);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $newCars
     * @return void
     */
    public function createAction(\Vehicle\Cars\Domain\Model\Cars $newCars)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->carsRepository->add($newCars);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $cars
     * @ignorevalidation $cars
     * @return void
     */
    public function editAction(\Vehicle\Cars\Domain\Model\Cars $cars)
    {
        $this->view->assign('cars', $cars);
    }

    /**
     * action update
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $cars
     * @return void
     */
    public function updateAction(\Vehicle\Cars\Domain\Model\Cars $cars)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->carsRepository->update($cars);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $cars
     * @return void
     */
    public function deleteAction(\Vehicle\Cars\Domain\Model\Cars $cars)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->carsRepository->remove($cars);
        $this->redirect('list');
    }

    /**
     * action filter
     *
     * @param \Vehicle\Cars\Domain\Model\Cars $filterCar
     * @return void
     */
    public function filterAction(\Vehicle\Cars\Domain\Model\Cars $filterCar = NULL)
    {
        // Return to the listing page if object is null        
        if ($filterCar == NULL) {
            $this->redirect('list');
        }

        if(count($filterCar->getCarClass())>0
            || count($filterCar->getFuelType())>0
            || $filterCar->getMaxprice()!=null
            || $filterCar->getMinprice()!=null
            || $filterCar->getCompany()!=null) {

            // Get Item per page
            $recPerPage = $this->settings['maxItem'];

            //get number of records
            $counts = count($this->carsRepository->FindByFilter($filterCar,0,0));

            // Create pages segment of the totle page
            $totle = ceil($counts/$recPerPage);
            
            // Get target page id
            $targetpage = $filterCar->getPageno();
            
            if($targetpage) {                          
                $curpage = $targetpage;
            } else {
                $curpage = 1; 
            }

            // Count Offset
            $offset = ($targetpage-1) * $recPerPage;
            
            if($curpage > 1) 
            {
                // Previous
                $previous=$curpage-1;
            }  
            
            if($curpage < $totle )
            {   
                // Next
                $next = $curpage+1;
            }

            $pages = array();
            
            for($i=1 ; $i<=$totle ;$i++)
            {   
                $pages[] = $i;
            }

            $companies = $this->companyRepository->findAll();
            $this->view->assign('company', $companies);

            $fluelTypes = $this->fluelTypeRepository->findAll();
            $this->view->assign('fluelTypes', $fluelTypes);

            $fluelTypes = $this->carClassRepository->findAll();
            $this->view->assign('carClass', $fluelTypes);

            $filterData = $this->carsRepository->FindByFilter($filterCar, intval($offset), intval($recPerPage));
            
            $this->view->assign('filterData', $filterData);

            $this->view->assign('carFilter', $filterCar);
            $this->view->assign('minprice',$filterCar->getMinprice());
            $this->view->assign('maxprice',$filterCar->getMaxprice());

            $this->view->assign('pages',$pages);
            $this->view->assign('curpage', $curpage);
            $this->view->assign('previous',$previous);
            $this->view->assign('next',$next);
            $this->view->assign('totalpage', $totle);
        }

    }
}
