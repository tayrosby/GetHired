<?php
/*
 * Authors: Taylor Rosby
 * Date: February 27, 2019
 * Description: GroupModel holds attributes for a group
 */
namespace App\Model;

class GroupModel 
{
    //group attributes
    private $id;
    private $groupName;
    private $groupDescription;
    private $interest;
    private $userID;
    
    //constructor
    public function __construct($id, $groupName, $groupDescription, $interest, $userID)
    {
        $this->id = $id;
        $this->groupName = $groupName;
        $this->groupDescription = $groupDescription;
        $this->interest = $interest;
        $this->userID = $userID;
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
