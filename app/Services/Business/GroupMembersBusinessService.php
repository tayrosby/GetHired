<?php
/*
 * Authors: Taylor Rosby
 * Date: February 28, 2019
 * Description: GroupMemberBusinessService is responsible for handling group member related requests
 */

namespace App\Services\Business;

use App\Services\Utility\Connection;
use App\Services\Data\GroupMembersDataService;

class GroupMembersBusinessService {
    
    //allows the user to add themselves to a group
    public function joinGroup($member)
    {
        //creates a database connection
        $db = new Connection();
        $conn = $db->open();
        
        //call the data service
        $service = new GroupMembersDataService($conn);
        
        //call the create function in the data service
        $success = $service->createMember($member);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if($success == 1){
            return true;
        }
        //else return false
        else {return false;}
    }
    
    //allows the user to remove themselves from the group
    public function leaveGroup($id)
    {
        //creates a new connection
        $db = new Connection();
        $conn = $db->open();
        
        //call the data service
        $service = new GroupMembersDataService($conn);
        
        //call the delete function in the data service
        $success = $service->deleteMember($id);
        
        //closes the connection
        $conn = null;
        
        //if sussecful return true
        if($success == 1){
            return true;
        }
        //else return false
        else {return false;}
    }
}
