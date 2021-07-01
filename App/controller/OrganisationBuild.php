<?php namespace App\controller;

use App\models\organisation\Division;
use App\models\organisation\Organisation;
use App\models\organisation\OrganisationUnitConfig;
use App\models\organisation\Branch;
use App\models\organisation\Area;

class OrganisationBuild
{
    public static function buildOrganisation():Organisation
    {
        $organisationConfig = new OrganisationUnitConfig(true, 35000);
        $organisation = new Organisation('Spicerhaart', $organisationConfig);

        $divisionAConfig = new OrganisationUnitConfig(false, 0);
        $divisionA = new Division('Division A', null, $organisation);
        $organisation->addDivision($divisionA);

        $areaAConfig = new OrganisationUnitConfig(false, 0);
        $areaA = new Area('Area A', null, $divisionA);
        $divisionA->addArea($areaA);

        $branchAConfig = new OrganisationUnitConfig(true, 1000);
        $branchA = new Branch('Branch A', null, $areaA);
        $areaA->addBranch($branchA);



        return $organisation;
    }
}
