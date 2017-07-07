<?php
namespace Vehicle\Cars\Domain\Repository;

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
 * The repository for Cars
 */
class CarsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

	private $company = NULL;
	private $fueltype;
	private $cclass;

	/**
     * Get Objects by filter
     *
     * @param text $count
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
     */
	public function FindByFilter($arg = '',$offset='', $limit='')
	{
		$this->company = $arg->getCompany();
		$this->fueltype = $arg->getFuelType()->toArray();
		$this->cclass = $arg->getCarClass();

		$query = $this->createQuery();
		$filterData = [];

		$filterData[] = $query->equals('company', $this->company);

		if (count($carcla)>1) {
			$filterData[] = $query->in('carClass',$this->cclass);
		}

		if(count($this->fueltype)>1){
			foreach ($this->fueltype as $key => $value) {
	    		if($value != NULL){
					$queryFuel[] = $query->contains('fuelType',$value->getUid());
	    		}
        	}
			$filterData[] = $query->logicalOr($queryFuel);
		}


		if ($arg->getMaxprice()) {
			$filterData[] = $query->greaterThanOrEqual('price', $arg->getMaxprice());
		}

		if ($arg->getMinprice()) {
			$filterData[] = $query->lessThanOrEqual('price', $arg->getMinprice());
		}

		if ($offset>0) {
			$query->setOffset($offset);
		}
		if ($limit>0) {
			$query->setLimit($limit);
		}		
		

		$query->matching(
	  		$query->logicalAnd($filterData)
  		);

  		return $query->execute();
	}

	public function findAll()
	{
		$query = $this->createQuery();
		$constraints =  $query->statement("SELECT * FROM tx_cars_domain_model_cars");
        $query->logicalAnd($constraints);
        return $result= $query->execute();
	}

	/**
    * Debugs a SQL query from a QueryResult
    *
    * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
    * @param boolean $explainOutput
    * @return void
    */
    public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE){
		$GLOBALS['TYPO3_DB']->debugOutput = 2;
		if($explainOutput){
			$GLOBALS['TYPO3_DB']->explainOutput = true;
		}
		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
		$queryResult->toArray();
		Debug::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
		$GLOBALS['TYPO3_DB']->explainOutput = false;
		$GLOBALS['TYPO3_DB']->debugOutput = false;
    }

}
