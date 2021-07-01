<?php namespace App\models;

use App\models\organisation\Branch;
use App\models\organisation\OrganisationUnitConfig;
use Exception;

const MONTH = array( //TODO test for edge cases
    "min" => 11000,
    "max" => 866000
);

const WEEK = array(
    "min" => 2500,
    "max" => 200000
);

const VAT = 0.2; //TODO VAT is not always at fixed rate

class MembershipCalculator
{
    private int $rentAmount;
    private string $rentPeriod;
    private Branch $branch;

    /**
     * @throws Exception
     */

    public function calculateMembershipFee(int $rentAmount, string $rentPeriod, Branch $branch) :int
    {
        $isRentAmountValid = $this->isRentAmountInRange($rentAmount, $rentPeriod);

        if(!$isRentAmountValid)
        {
            throw new Exception("The rent amount supplied is not in range!");
        }

        if($rentPeriod !== 'month' && $rentPeriod !== 'week')
        {
            throw new Exception('Weekly or Monthly rent period is only allowed!');
        }

        $this->rentAmount = $rentAmount; // assign variable to class properties once validation checks are over.
        $this->rentPeriod = $rentPeriod;
        $this->branch = $branch;
        $config = $this->getConfig();

        if ($config !== null && $config->isMembershipFeeFixed())
        {
            return $config->getMembershipFee();
        }

        $oneWeeksRent = $rentPeriod == 'week' ? $this->rentAmount : $this->rentAmount / 4;

       if ($oneWeeksRent < 12000)
       {
           return round(12000 * (VAT + 1)); //convert float to an integer using the round method
       } else
       {
           return round($oneWeeksRent * (VAT + 1));
       }
    }

    private function isRentAmountInRange(int $rentAmount, string $rentPeriod) :bool
    {
        $monthlyRange = $rentAmount >= MONTH['min'] && $rentAmount <= MONTH['max'];
        $weeklyRange = $rentAmount >= WEEK['min'] && $rentAmount <= WEEK['max'];

        return $rentPeriod == 'month' ? $monthlyRange : $weeklyRange;
    }

    private function getConfig() :?OrganisationUnitConfig
    {
        $config = $this->branch->getBranchConfig();

        if ($config == null || !$config->isMembershipFeeFixed())
        {
            $config = $this->branch->getArea()->getAreaConfig();
        }
        if ($config == null || !$config->isMembershipFeeFixed())
        {
            $config = $this->branch->getArea()->getDivision()->getDivisionConfig();
        }
        if ($config == null || !$config->isMembershipFeeFixed())
        {
            $config = $this->branch->getArea()->getDivision()->getOrganisation()->getOrganisationConfig();
        }

        return $config;
    }
}