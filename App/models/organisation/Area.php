<?php namespace App\models\organisation;

use App\models\organisation\OrganisationUnitConfig;


class Area
{
    private string $name;
    private Division $division;
    private array $branches = [];
    private ?OrganisationUnitConfig $config = null; // Question mark means this attribute can be NULL

    function __construct(string $name, ?OrganisationUnitConfig $config, Division $division)
    {
        $this->name = $name;
        $this->config = $config;
        $this->division = $division;
    }

    public function addBranch(Branch $branch)
    {
        $this->branches[] = $branch;
    }

    public function getAreaConfig() : ?OrganisationUnitConfig
    {
        return $this->config;
    }

    public function getDivision()
    {
        return $this->division;
    }
}
