<?php namespace App\test;

use App\models\organisation\Area;
use App\models\organisation\Branch;
use App\models\organisation\Division;
use App\models\organisation\Organisation;
use App\models\organisation\OrganisationUnitConfig;
use App\models\MembershipCalculator;
use PHPUnit\Framework\TestCase;

class MembershipCalculatorTest extends TestCase
{
    /**
     * @test
     */

    public function shouldReturnTheMinimumMembershipFeeWithNoOrganisationUnitConfigGiven()
    {
        $organisation = new Organisation("Haart", null);

        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);

        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $membershipCalculator = new MembershipCalculator();
        $feeQuote = $membershipCalculator->calculateMembershipFee(10000, 'week', $branchA);

        $this->assertEquals(14400, $feeQuote);
    }

    /**
     * @test
     */
    public function shouldReturnOneWeeksRentWithNoOrganisationUnitConfigGiven()
    {
        $organisation = new Organisation("Haart", null);

        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);

        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $membershipCalculator = new MembershipCalculator();
        $feeQuote = $membershipCalculator->calculateMembershipFee(864054, 'month', $branchA);

        $this->assertEquals(259216, $feeQuote);
    }

    /**
     * @test
     */

    public function shouldReturnTheFixedMembershipFeeOfOrganisationUnitConfig()
    {
        $organisationConfig = new OrganisationUnitConfig(true, 35000); //organisarion has a fixed fee of 35000
        $organisation = new Organisation("Haart", $organisationConfig);

        $divisionAConfig = new OrganisationUnitConfig(false, 0);
        $divisionA = new Division("Division A", $divisionAConfig, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);

        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $membershipCalculator = new MembershipCalculator();
        $feeQuote = $membershipCalculator->calculateMembershipFee(20000, 'month', $branchA);

        $this->assertEquals(35000, $feeQuote);
    }
    /**
     * @test
     */

    public function shouldReturnFixedMembershipFeeOfDivisionConfig()
    {
        $organisationConfig = new OrganisationUnitConfig(true, 35000); //organisarion has a fixed fee of 35000
        $organisation = new Organisation("Haart", $organisationConfig);

        $divisionAConfig = new OrganisationUnitConfig(true, 15000);
        $divisionA = new Division("Division A", $divisionAConfig, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);

        $branchBConfig = new OrganisationUnitConfig(false, 0);
        $branchA = new Branch("Branch A", $branchBConfig, $areaA);
        $areaA->addBranch($branchA);

        $membershipCalculator = new MembershipCalculator();
        $feeQuote = $membershipCalculator->calculateMembershipFee(20000, 'month', $branchA);

        $this->assertEquals(15000, $feeQuote);
    }

    /**
     * @test
     */

    public function shouldThrowAnExceptionIfWeeklyRentIsAboveRange()
    {
        $organisation = new Organisation("Haart", null);


        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $this->expectException("Exception");
        $this->expectExceptionMessage("The rent amount supplied is not in range!");

        $membershipCalculator = new MembershipCalculator();
        $membershipCalculator->calculateMembershipFee(250000, 'week', $branchA);
    }

    /**
     * @test
     */

    public function shouldThrowAnExceptionIfWeeklyRentIsBelowRange()
    {
        $organisation = new Organisation("Haart", null);


        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $this->expectException("Exception");
        $this->expectExceptionMessage("The rent amount supplied is not in range!");

        $membershipCalculator = new MembershipCalculator();
        $membershipCalculator->calculateMembershipFee(100, 'week', $branchA);
    }

    /**
     * @test
     */

    public function shouldThrowAnExceptionIfMonthlyRentIsAboveRange()
    {
        $organisation = new Organisation("Haart", null);


        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $this->expectException("Exception");
        $this->expectExceptionMessage("The rent amount supplied is not in range!");

        $membershipCalculator = new MembershipCalculator();
        $membershipCalculator->calculateMembershipFee(900000, 'month', $branchA);
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionIfMonthlyRentIsBelowRange()
    {
        $organisation = new Organisation("Haart", null);

        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $this->expectException("Exception");
        $this->expectExceptionMessage("The rent amount supplied is not in range!");

        $membershipCalculator = new MembershipCalculator();
        $membershipCalculator->calculateMembershipFee(10900, 'month', $branchA);
    }

    /**
     @test
     */
    public function throwExceptionIfRentPeriodDoesNotIncludeMonthOrWeek()
    {
        $organisation = new Organisation("Haart", null);

        $divisionA = new Division("Division A", null, $organisation);
        $organisation->addDivision($divisionA);

        $areaA = new Area("Area", null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch("Branch A", null, $areaA);
        $areaA->addBranch($branchA);

        $this->expectException("Exception");
        $this->expectExceptionMessage("Weekly or Monthly rent period is only allowed!");

        $membershipCalculator = new MembershipCalculator();
        $membershipCalculator->calculateMembershipFee(11000, 'year', $branchA);
    }

}