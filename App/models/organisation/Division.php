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
        $this->name=$name;
        $this->config = $config;
        $this->organisation = $organisation;
    }

    public function addArea(Area $area)
    {
        $this->areas[] = $area;
    }

    public function getAreas()
    {
        return $this->areas;
    }

    public function getNames()
    {
        return $this->name;
    }

    public function getDivisionConfig() :?OrganisationUnitConfig
    {
        return $this->config;
    }

    public function getOrganisation() :Organisation
    {
        return $this->organisation;
    }

    public function getAreaByName(string $areaName)
    {
        foreach ($this->areas as $area) {
            if ($area->getName() == $areaName)
            {
                return $area;
            }
        }
        return null;
    }

//    public function getBranchByName(string $branchName)
//    {
//        $result= null;
//        foreach ($this->areas as $area) {
//            if ($area->getName() == $branchName)
//            {
//                $result = $area;
//            }
//        }
//
//        return $result;
//    }
}