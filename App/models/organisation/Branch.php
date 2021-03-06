<?php namespace App\models\organisation;

use App\models\organisation\OrganisationUnitConfig;
use App\models\organisation\Area;

class Branch
{
    private string $name;
    private Area $area;
    private ?OrganisationUnitConfig $config = null; // Question mark means this attribute can be NULL

    function __construct(string $name, ?OrganisationUnitConfig $config, Area $area)
    {
        $this->name=$name;
        $this->config = $config;
        $this->area = $area;
    }

    public function getBranchConfig() :?OrganisationUnitConfig
    {
        return $this->config;
    }

    public function getArea() :Area
    {
        return $this->area;
    }

    public function getName() :string
    {
        return $this->name;
    }
}
