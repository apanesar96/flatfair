<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\OrganisationRentalBuild;

$quotation = OrganisationRentalBuild::buildRentalFee();

var_dump($quotation);