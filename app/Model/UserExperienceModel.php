<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserExperienceModel holds the attributes for experience in the profile
 */
namespace App\Model;

class UserExperienceModel
{
    //attributes
    private $id;
    private $position;
    private $company;
    private $location;
    private $yearsActive;
    private $duties;
    
    //constructor
    public function __construct($id, $position, $company, $location, $yearsActive, $duties)
    {
        $this->id = $id;
        $this->position = $position;
        $this->company = $company;
        $this->location = $location;
        $this->yearsActive = $yearsActive;
        $this->duties = $duties;
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>