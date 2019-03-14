<?php
/*
 * Authors: Taylor Rosby
 * Date: February 27, 2019
 * Description: GroupBusinessService is responsible for handling group related requests.
 */
namespace App\Services\Business;

use App\Services\Data\GroupDataService;
use App\Services\Utility\Connection;

class GroupBusinessService 
{

    /**
     * allows the creation of a group
     * @param $group
     * @return boolean
     */
    public function addGroup($group)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //sends the model to the create function in the data service
        $success = $service->createGroup($group);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        //else return false
        else { return false; }
    }

    /**
     * allows the group admin to delete the group
     * @param $id
     * @return boolean
     */
    public function deleteGroup($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //sends the model to the delete function in the data service
        $success = $service->deleteGroup($id);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
    }

    /**
     * allows the group admin to update the group
     * @param $group
     * @return boolean
     */
    public function updateGroup($group)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //sends the model to the edit function in the data service
        $success = $service->editGroup($group);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
    }
    
    /**
     * gets all the groups in the database
     * @return array
     */
    public function findAllGroups()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of education
        $groups = Array();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //calls the find all method in the data service
        $groups = $service->findAllGroups();
        
        //closes the connection
        $conn = null;
        
        //return the array
        return $groups;
    }
    
    /**
     * gets all the members in a group
     * @return array
     */
    function findAllGroupMembers(){
        //creates an array
        $groupMembers = Array();
        
        //creates a database connection
        $db = new Connection();
        $conn = $db->open();
        
        //sends connection to data service
        $dbService = new GroupDataService($conn);
        
        //return the array
        $groupMembers = $dbService->findAllGroupMembers();
        return $groupMembers;
    }
}
