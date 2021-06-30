<?php namespace App\models\organisation;

use App\models\organisation\OrganisationUnitConfig;


class Organisation
{
    private string $name;
    private array $divisions = [];
    private ?OrganisationUnitConfig $config; // Question mark means this attribute can be NULL

    function __construct(string $name, ?OrganisationUnitConfig $config)
    {
        $this->name = $name;
        $this->config = $config;
    }

    public function addDivision(Division $division)
    {
        $this->divisions[] = $division;
        return $this;
    }

    public function getDivisions()
    {
        return $this->divisions;
    }

    public function getAreas(string $divisionName)
    {
        return $this->divisons[0]->getAreas();
    }

    public function getOrganisationConfig() :?OrganisationUnitConfig
    {
        return $this->config;
    }

}