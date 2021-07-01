<?php namespace App\models\organisation;

use App\models\organisation\OrganisationUnitConfig;


class Organisation
{
    private string $name;
    private array $divisions = []; // one to many relationship stated across the structure
    private ?OrganisationUnitConfig $config; // Question mark means this attribute can be NULL

    function __construct(string $name, ?OrganisationUnitConfig $config)
    {
        $this->name = $name;
        $this->config = $config;
    }

    public function addDivision(Division $division): Organisation
    {
        $this->divisions[] = $division;
        return $this;
    }

    public function getDivisions() //TODO furture iterations: Find branch name from orgnisation level => Searching branch through children
    {
        return $this->divisions;
    }

    public function getOrganisationConfig() :?OrganisationUnitConfig
    {
        return $this->config;
    }
}