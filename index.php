<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\OrganisationBuild;


use App\models\MembershipCalculator;
use App\models\organisation\Area;
use App\models\organisation\Branch;
use App\models\organisation\Division;
use App\models\organisation\Organisation;
use App\models\organisation\OrganisationUnitConfig;


//$organisation = OrganisationBuild::buildOrganisation();

$organisationConfig = new OrganisationUnitConfig(true, 35000);
$organisation = new Organisation('Spicerhaart', null);

$divisionAConfig = new OrganisationUnitConfig(false, 0);
$divisionA = new Division('Division A', null, $organisation);
$organisation->addDivision($divisionA);

$areaAConfig = new OrganisationUnitConfig(false, 0);
$areaA = new Area('Area A', null, $divisionA);
$divisionA->addArea($areaA);

$branchAConfig = new OrganisationUnitConfig(true, 1000);
$branchA = new Branch('Branch A', null, $areaA);
$areaA->addBranch($branchA);


$OrganisationConfig = $organisation->getOrganisationConfig();

$membershipCalculator = new MembershipCalculator();

$feeQuote = $membershipCalculator->calculateMembershipFee(20000, 'month', $branchA);

var_dump($feeQuote);
