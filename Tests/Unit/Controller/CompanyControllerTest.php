<?php
namespace Vehicle\Cars\Tests\Unit\Controller;

/**
 * Test case.
 */
class CompanyControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Controller\CompanyController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Vehicle\Cars\Controller\CompanyController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllCompaniesFromRepositoryAndAssignsThemToView()
    {

        $allCompanies = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $companyRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CompanyRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $companyRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCompanies));
        $this->inject($this->subject, 'companyRepository', $companyRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('companies', $allCompanies);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
