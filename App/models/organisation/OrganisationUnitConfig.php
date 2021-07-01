<?php namespace App\models\organisation;

class OrganisationUnitConfig
{
    private bool $hasFixedMembershipFee;
    private int $membershipFee;

    function __construct(bool $hasFixedMembershipFee, int $membershipFee)
    {
        $this->hasFixedMembershipFee = $hasFixedMembershipFee;
        $this->membershipFee = $membershipFee;
    }

    public function isMembershipFeeFixed() :bool
    {
        return $this->hasFixedMembershipFee;
    }

    public function getMembershipFee() :int
    {
        return $this->membershipFee;
    }
}
