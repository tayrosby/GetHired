<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserExperienceModel holds the attributes for experience in the profile
 */
namespace App\Model;

class UserExperienceModel implements \JsonSerializable
{
    //attributes
    private $id;
    private $position;
    private $company;
    private $location;
    private $yearsActive;
    private $duties;
    
    /**
     * constructor
     * @param $id
     * @param $position
     * @param $company
     * @param $location
     * @param $yearsActive
     * @param $duties
     */
    public function __construct($id, $position, $company, $location, $yearsActive, $duties)
    {
        $this->id = $id;
        $this->position = $position;
        $this->company = $company;
        $this->location = $location;
        $this->yearsActive = $yearsActive;
        $this->duties = $duties;
    }
    
    /**
     * Getter
     * @param $property
     * @return $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
?>
