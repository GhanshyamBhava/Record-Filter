<?php
namespace Vehicle\Cars\Tests\Unit\Controller;

/**
 * Test case.
 */
class FluelTypeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Controller\FluelTypeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Vehicle\Cars\Controller\FluelTypeController::class)
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
    public function listActionFetchesAllFluelTypesFromRepositoryAndAssignsThemToView()
    {

        $allFluelTypes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fluelTypeRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\FluelTypeRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $fluelTypeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFluelTypes));
        $this->inject($this->subject, 'fluelTypeRepository', $fluelTypeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('fluelTypes', $allFluelTypes);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
