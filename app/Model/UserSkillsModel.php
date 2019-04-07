<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserSkillsModel holds the attributes for skills in the profile
 */
namespace App\Model;

class UserSkillsModel implements \JsonSerializable
{
    //attributes
    private $id;
    private $skillName;

    /**
     * constructor
     * @param $id
     * @param $skillName
     */
    public function __construct($id, $skillName)
    {
        $this->id = $id;
        $this->skillName = $skillName;

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
