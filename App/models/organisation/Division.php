<?php namespace App\models\organisation;

use App\models\organisation\OrganisationUnitConfig;

class Division
{
    private string $name;
    private array $areas = [];
    private Organisation $organisation;
    private ?OrganisationUnitConfig $config = null; // Question mark means this attribute can be NULL

    function __construct(string $name, ?OrganisationUnitConfig $config, Organisation $organisation)
    {
        $this->name = $name;
        $this->config = $config;
        $this->organisation = $organisation;
    }

    public function addArea(Area $area)
    {
        $this->areas[] = $area;
    }

    public function getDivisionConfig(): ?OrganisationUnitConfig
    {
        return $this->config;
    }

    public function getOrganisation(): Organisation
    {
        return $this->organisation;
    }

    public function getAreaByName(string $areaName) //TODO future iterations: searching through divisions, areas to get the correct branch to the parent organisation
    {
        foreach ($this->areas as $area) {
            if ($area->getName() == $areaName) {
                return $area;
            }
        }
        return null;
    }
}
