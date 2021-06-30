<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\OrganisationBuild;


use App\models\MembershipCalculator;
use App\models\organisation\Area;
use App\models\organisation\Branch;
use App\models\organisation\Division;
use App\models\organisation\Organisation;
use App\models\organisation\OrganisationUnitConfig;


$organisation = OrganisationBuild::buildOrganisation();



$OrganisationConfig = $organisation->getOrganisationConfig();

$membershipCalculator = new MembershipCalculator(26000, 'month', $branchA);

$membershipCalculator->getOrganisationFee();
