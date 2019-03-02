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
    
    //allows the creation of a group
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
    
    //allows the group admin to delete the group
    public function delete($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //sends the model to the delete function in the data service
        $success = $service->deleteJob($id);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
    }
    
    //allows the group admin to update the group
    public function updateGroup($group)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new GroupDataService($conn);
        
        //sends the model to the edit function in the data service
        $success = $service->editJob($group);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
    }
    
    //gets all the groups in the database
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
        $groups = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //return the array
        return $groups;
    }
}