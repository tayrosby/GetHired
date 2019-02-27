<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserSkillsModel holds the attributes for skills in the profile
 */
namespace App\Model;

class UserSkillsModel
{
    //attributes
    private $id;
    private $skillName;

    //constructor
    public function __construct($id, $skillName)
    {
        $this->id = $id;
        $this->skillName = $skillName;

    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>