<?php
namespace Vehicle\Cars\Tests\Unit\Controller;

/**
 * Test case.
 */
class CarClassControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Controller\CarClassController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Vehicle\Cars\Controller\CarClassController::class)
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
    public function listActionFetchesAllCarClassesFromRepositoryAndAssignsThemToView()
    {

        $allCarClasses = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $carClassRepository = $this->getMockBuilder(\Vehicle\Cars\Domain\Repository\CarClassRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $carClassRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCarClasses));
        $this->inject($this->subject, 'carClassRepository', $carClassRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('carClasses', $allCarClasses);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
