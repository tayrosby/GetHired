<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\UserDataService;
use App\Services\Utility\Connection;

class UserBusinessService
{
    /**
     * passes the model to the data service
     * @param $id
     * @return boolean
     */
    public function suspendUser($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new UserDataService($conn);
        
        //calls the edit method in the data service
        $suspendSuccess = $service->updateUser($id);
        
        //closes the connection
        $conn = null;
        
        //if successful return true, else return false
        if ($suspendSuccess == 1) { return true; }
        else { return false; }
    }
    
    /**
     * passes the model to the data service
     * @param $id
     * @return boolean
     */
    public function deleteUser($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new UserDataService($conn);
        
        //calls the delete method in the data service
        $deleteSuccess = $service->deleteUser($id);
        
        //closes the connection
        $conn = null;
        
        //if successful return true, else return false
        if ($deleteSuccess == 1) { return true; }
        else { return false; }
    }
    
    /**
     * gets a user from the database based on id
     * @param $id
     * @return NULL[]
     */
    public function getUser($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new UserDataService($conn);
        
        //calls the get user method in the data service
        $result = $service->getUser($id);
        
        //closes the connection
        $conn = null;
        
        //returns the user
        return $result;
    }
    
    /**
     * finds all the users in the database
     * @return array
     */
    public function getAllUsers()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new UserDataService($conn);
        
        //calls the fins all method in the data service
        $users = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //returns the users
        return $users;
    }
}
?>
