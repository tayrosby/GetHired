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
    //passes the model to the data service
    public function suspend($id)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new UserDataService($conn);
        
        
        $suspendSuccess = $service->updateUser($id);
        
        $conn = null;
        if ($suspendSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function delete($id)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new UserDataService($conn);
        $deleteSuccess = $service->deleteUser($id);
        
        $conn = null;
        if ($deleteSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function getUser($id)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new UserDataService($conn);
        $result = $service->getUser($id);
        
        return $result;
    }
    
    public function getAll()
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new UserDataService($conn);
        $users = $service->findAll();
        
        $conn = null;
        return $users;
    }
}
?>