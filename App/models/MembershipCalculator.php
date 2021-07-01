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

    public function calculateMembershipFee(int $rentAmount, string $rentPeriod, Branch $branch) :int
    {
        $isRentAmountValid = $this->isRentAmountInRange($rentAmount, $rentPeriod);

        if(!$isRentAmountValid)
        {
            throw new Exception('The rent amount was not in range!');
        }

        if($rentPeriod !== 'month' || $rentPeriod !== 'week')
        {
            throw new Exception('Weekly or Monthly rent period is only allowed!');
        }

        $this->rentAmount = $rentAmount;
        $this->$rentPeriod = $rentPeriod;
        $this->branch = $branch;

        $config = $this->getConfig();

        if ($config !== null && $config->isMembershipFeeFixed())
        {

            return $config->getMembershipFee();
        }

        $oneWeeksRent = $rentPeriod == 'week' ? $rentAmount : $rentAmount / 4;

       if ($oneWeeksRent < 120)
       {
           return round(120 * (VAT + 1)); //convert float to an integer using the round method
       } else
       {
           return round($oneWeeksRent * (VAT + 1));
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