<?php
namespace Vehicle\Cars\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class CarsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Vehicle\Cars\Domain\Model\Cars
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Vehicle\Cars\Domain\Model\Cars();
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

    /**
     * @test
     */
    public function getImageReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getImage()
        );

    }

    /**
     * @test
     */
    public function setImageForFileReferenceSetsImage()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setImage($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'image',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getPrice()
        );

    }

    /**
     * @test
     */
    public function setPriceForFloatSetsPrice()
    {
        $this->subject->setPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'price',
            $this->subject,
            '',
            0.000000001
        );

    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );

    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCompanyReturnsInitialValueForCompany()
    {
        self::assertEquals(
            null,
            $this->subject->getCompany()
        );

    }

    /**
     * @test
     */
    public function setCompanyForCompanySetsCompany()
    {
        $companyFixture = new \Vehicle\Cars\Domain\Model\Company();
        $this->subject->setCompany($companyFixture);

        self::assertAttributeEquals(
            $companyFixture,
            'company',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCarClassReturnsInitialValueForCarClass()
    {
        self::assertEquals(
            null,
            $this->subject->getCarClass()
        );

    }

    /**
     * @test
     */
    public function setCarClassForCarClassSetsCarClass()
    {
        $carClassFixture = new \Vehicle\Cars\Domain\Model\CarClass();
        $this->subject->setCarClass($carClassFixture);

        self::assertAttributeEquals(
            $carClassFixture,
            'carClass',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getFuelTypeReturnsInitialValueForFluelType()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getFuelType()
        );

    }

    /**
     * @test
     */
    public function setFuelTypeForObjectStorageContainingFluelTypeSetsFuelType()
    {
        $fuelType = new \Vehicle\Cars\Domain\Model\FluelType();
        $objectStorageHoldingExactlyOneFuelType = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneFuelType->attach($fuelType);
        $this->subject->setFuelType($objectStorageHoldingExactlyOneFuelType);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneFuelType,
            'fuelType',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addFuelTypeToObjectStorageHoldingFuelType()
    {
        $fuelType = new \Vehicle\Cars\Domain\Model\FluelType();
        $fuelTypeObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $fuelTypeObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($fuelType));
        $this->inject($this->subject, 'fuelType', $fuelTypeObjectStorageMock);

        $this->subject->addFuelType($fuelType);
    }

    /**
     * @test
     */
    public function removeFuelTypeFromObjectStorageHoldingFuelType()
    {
        $fuelType = new \Vehicle\Cars\Domain\Model\FluelType();
        $fuelTypeObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $fuelTypeObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($fuelType));
        $this->inject($this->subject, 'fuelType', $fuelTypeObjectStorageMock);

        $this->subject->removeFuelType($fuelType);

    }
}
