<?php namespace App\controller;

use App\models\organisation\Division;
use App\models\organisation\Organisation;
use App\models\organisation\OrganisationUnitConfig;
use App\models\organisation\Branch;
use App\models\organisation\Area;
use App\models\MembershipCalculator;

class OrganisationRentalBuild
{
    public static function buildRentalFee() :int
    {
        $organisationConfig = new OrganisationUnitConfig(true, 35000);
        $organisation = new Organisation('Spicerhaart', $organisationConfig);

        $divisionAConfig = new OrganisationUnitConfig(false, 0);
        $divisionA = new Division('Division A', $divisionAConfig, $organisation);
        $organisation->addDivision($divisionA);


        $areaA = new Area('Area A', null, $divisionA);
        $divisionA->addArea($areaA);


        $branchA = new Branch('Branch A', null, $areaA);
        $areaA->addBranch($branchA);

        $membershipCalculator = MembershipCalculator::getInstance();

        return $membershipCalculator->calculateMembershipFee(11000, 'month', $branchA);
    }
}
