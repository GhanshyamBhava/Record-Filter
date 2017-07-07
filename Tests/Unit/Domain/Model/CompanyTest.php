<?php
namespace Vehicle\Cars\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class CompanyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Domain\Model\Company
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Vehicle\Cars\Domain\Model\Company();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );

    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );

    }
}
