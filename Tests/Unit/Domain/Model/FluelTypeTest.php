<?php
namespace Vehicle\Cars\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class FluelTypeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Domain\Model\FluelType
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Vehicle\Cars\Domain\Model\FluelType();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );

    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );

    }
}
