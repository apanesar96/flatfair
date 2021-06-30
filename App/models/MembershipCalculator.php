<?php namespace App\models;

use App\models\organisation\Branch;
use App\models\organisation\OrganisationUnitConfig;
use Exception;

const MONTH = array(
    "min" => 11000,
    "max" => 866000
);

const WEEK = array(
    "min" => 2500,
    "max" => 200000
);

const VAT = 0.2;

class MembershipCalculator
{
    private int $rentAmount;
    private string $rentPeriod;
    private Branch $branch;

    private function isRentAmountInRange(int $rentAmount, string $rentPeriod) :bool
    {
        $monthlyRange = $rentAmount >= MONTH['min'] && $rentAmount <= MONTH['max'];
        $weeklyRange = $rentAmount >= WEEK['min'] && $rentAmount <= WEEK['max'];

        return $rentPeriod == 'month' ? $monthlyRange : $weeklyRange;
    }

    public function calculateMembershipFee(int $rentAmount, string $rentPeriod, Branch $branch)
    {
        if(!isRentAmountInRange($rentAmount, $rentPeriod))
        {
            throw new Exception('The rent amount was not in range!');
        }

        $config = $this->getConfig();

        if ($config !== null && $config->hasFixedMembershipFee())
        {
            return $config->getMembershipFee();
        }

        $oneWeeksRent = $rentPeriod == 'week' ? $rentAmount : $rentAmount / 4;

       if ($oneWeeksRent < 120)
       {
           return 120 * (VAT + 1);
       } else
       {
           return $oneWeeksRent * (VAT + 1);
       }
    }

    private function getConfig() :?OrganisationUnitConfig
    {
        $config = $this->branch->getBranchConfig();

        if ($config == null)
        {
            $config = $this->branch->getArea()->getAreaConfig();
        }
        if ($config == null)
        {
            $config = $this->branch->getArea()->getDivision()->getDivisionConfig();
        }
        if ($config == null)
        {
            $config = $this->branch->getArea()->getDivision()->getOrganisation()->getOrganisationConfig();
        }

        return $config;
    }
}