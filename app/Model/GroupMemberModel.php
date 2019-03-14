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
    private $groupID;
    private $userID;
    
    /**
     * constructor
     * @param $id
     * @param $groupID
     * @param $userID
     */
    public function __construct($id, $groupID, $userID)
    {
        $this->id = $id;
        $this->groupID = $groupID;
        $this->userID = $userID;
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
}
