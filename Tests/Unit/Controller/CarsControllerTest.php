<?php
namespace Vehicle\Cars\Tests\Unit\Controller;

/**
 * Test case.
 */
class CarsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Controller\CarsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Vehicle\Cars\Controller\CarsController::class)
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
    public function listActionFetchesAllCarssFromRepositoryAndAssignsThemToView()
    {

        $allCarss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $carsRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CarsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $carsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCarss));
        $this->inject($this->subject, 'carsRepository', $carsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('carss', $allCarss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCarsToView()
    {
        $cars = new \Vehicle\Cars\Domain\Model\Cars();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('cars', $cars);

        $this->subject->showAction($cars);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCarsToCarsRepository()
    {
        $cars = new \Vehicle\Cars\Domain\Model\Cars();

        $carsRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CarsRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $carsRepository->expects(self::once())->method('add')->with($cars);
        $this->inject($this->subject, 'carsRepository', $carsRepository);

        $this->subject->createAction($cars);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCarsToView()
    {
        $cars = new \Vehicle\Cars\Domain\Model\Cars();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('cars', $cars);

        $this->subject->editAction($cars);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCarsInCarsRepository()
    {
        $cars = new \Vehicle\Cars\Domain\Model\Cars();

        $carsRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CarsRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $carsRepository->expects(self::once())->method('update')->with($cars);
        $this->inject($this->subject, 'carsRepository', $carsRepository);

        $this->subject->updateAction($cars);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCarsFromCarsRepository()
    {
        $cars = new \Vehicle\Cars\Domain\Model\Cars();

        $carsRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CarsRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $carsRepository->expects(self::once())->method('remove')->with($cars);
        $this->inject($this->subject, 'carsRepository', $carsRepository);

        $this->subject->deleteAction($cars);
    }
}
