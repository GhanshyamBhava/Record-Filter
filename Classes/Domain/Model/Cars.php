<?php
namespace Vehicle\Cars\Domain\Model;
 
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
 * Cars
 */
class Cars extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @cascade remove
     */
    protected $image = null;


    /**
     * price
     *
     * @var float
     */
    protected $price = 0.0;

    /**
     * maxprice
     *
     * @var float
     */
    protected $maxprice = 0.0;

    /**
     * minprice
     *
     * @var float
     */
    protected $minprice = 0.0;

    /**
     * Pageno
     *
     * @var int
     */
    protected $pageno = 0;

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * company
     *
     * @var \Vehicle\Cars\Domain\Model\Company
     */
    protected $company = null;

    /**
     * fuelType
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\FluelType>
     * @cascade remove
     */
    protected $fuelType = null;

    /**
     * carClass
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\CarClass>
     * @cascade remove
     */
    protected $carClass = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->fuelType = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     *
     * @param float $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the maxprice
     *
     * @return float $maxprice
     */
    public function getMaxprice()
    {
        return $this->maxprice;
    }

    /**
     * Sets the maxprice
     *
     * @param float $maxprice
     * @return void
     */
    public function setMaxprice($maxprice)
    {
        $this->maxprice = $maxprice;
    }


    /**
     * Returns the minprice
     *
     * @return float $minprice
     */
    public function getMinprice()
    {
        return $this->minprice;
    }

    /**
     * Sets the minprice
     *
     * @param float $minprice
     * @return void
     */
    public function setMinprice($minprice)
    {
        $this->minprice = $minprice;
    }

    /**
     * Returns the pageno
     *
     * @return int $pageno
     */
    public function getPageno()
    {
        return $this->pageno;
    }

    /**
     * Sets the pageno
     *
     * @param int $pageno
     * @return void
     */
    public function setPageno($pageno)
    {
        $this->pageno = $pageno;
    }

    /**
     * Returns the company
     *
     * @return \Vehicle\Cars\Domain\Model\Company $company
     */
    public function getCompany()
    {
        return $this->company;
    }



    /**
     * Sets the company
     *
     * @param \Vehicle\Cars\Domain\Model\Company $company
     * @return void
     */
    public function setCompany(\Vehicle\Cars\Domain\Model\Company $company)
    {
        $this->company = $company;
    }

    /**
     * Adds a FluelType
     *
     * @param \Vehicle\Cars\Domain\Model\FluelType $fuelType
     * @return void
     */
    public function addFuelType(\Vehicle\Cars\Domain\Model\FluelType $fuelType)
    {
        $this->fuelType->attach($fuelType);
    }

    /**
     * Removes a FluelType
     *
     * @param \Vehicle\Cars\Domain\Model\FluelType $fuelTypeToRemove The FluelType to be removed
     * @return void
     */
    public function removeFuelType(\Vehicle\Cars\Domain\Model\FluelType $fuelTypeToRemove)
    {
        $this->fuelType->detach($fuelTypeToRemove);
    }

    /**
     * Returns the fuelType
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\FluelType> $fuelType
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Sets the fuelType
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\FluelType> $fuelType
     * @return void
     */
    public function setFuelType(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $fuelType)
    {
        $this->fuelType = $fuelType;
    }

    /*
     * Include car class function form the external model 
     **************************************************************************/

    /**
     * Adds a carClass
     *
     * @param \Vehicle\Cars\Domain\Model\CarClass $carClass
     * @return void
     */
    public function addCarClass(\Vehicle\Cars\Domain\Model\CarClass $carClass)
    {
        $this->carClass->attach($carClass);
    }

    /**
     * Removes a carClass
     *
     * @param \Vehicle\Cars\Domain\Model\CarClass $carClassToRemove The carClass to be removed
     * @return void
     */
    public function removeCarClass(\Vehicle\Cars\Domain\Model\CarClass $carClassToRemove)
    {
        $this->carClass->detach($carClassToRemove);
    }

    /**
     * Returns the carClass
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\CarClass> $carClass
     */
    public function getCarClass()
    {
        return $this->carClass;
    }

    /**
     * Sets the carClass
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Vehicle\Cars\Domain\Model\CarClass> $carClass
     * @return void
     */
    public function setCarClass(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $carClass)
    {
        $this->carClass = $carClass;
    }

}
