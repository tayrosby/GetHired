<?php
/*
 * Authors: Taylor Rosby
 * Date: February 27, 2019
 * Description: GroupMemberModel holds attributes for a group memeber
 */

namespace App\Model;

class GroupMemberModel 
{
    //group members attributes
    private $id;
    private $userID;
    
    //constructor
    public function __construct($id, $userID)
    {
        $this->id = $id;
        $this->userID = $userID;
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
