<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\OrganisationRentalBuild;

//$quotation = OrganisationRentalBuild::buildRentalFee();

$branchA = OrganisationRentalBuild::buildOrg();
var_dump($branchA);


$currentUnit = $branchA;
$currentMembershipFeeAmount = $currentUnit->getFixedMembershipFeeAmount();
while ($currentMembershipFeeAmount === null) {
    $currentUnit = $currentUnit->getParent();
    if ($currentUnit){
        $currentMembershipFeeAmount = $currentUnit->getFixedMembershipFeeAmount();
    } else {
        break;
    }
}

var_dump($currentMembershipFeeAmount);