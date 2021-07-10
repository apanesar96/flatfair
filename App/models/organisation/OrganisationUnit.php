<?php

namespace App\models\organisation;

class OrganisationUnit {
    private string $name;
    private ?int $fixedMembershipFeeAmount;
    private ?OrganisationUnit $parent = null; //reference to the class OrganisationUnit itself

    public function __construct(string $name, ?int $fixedMembershipFeeAmount)
    {
        $this->name = $name;
        $this->fixedMembershipFeeAmount = $fixedMembershipFeeAmount;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getFixedMembershipFeeAmount(): ?int
    {
        if ($this->fixedMembershipFeeAmount !== null) {
            return $this->fixedMembershipFeeAmount;
        }
        if (!$this->getParent()){
            return null;
        }
        return $this->getParent()->getFixedMembershipFeeAmount();
    }

    public function setParent(OrganisationUnit $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): ?OrganisationUnit
    {
        return $this->parent;
    }
}


