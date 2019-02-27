<?php
/*
 * Authors: Taylor Rosby
 * Date: Febraury 24, 2019
 * Description: SecurityService is responsible for handling authentication and authorization requests
 */
namespace App\Services\Business;
use App\Model\UserObjectModel;
use App\Model\Credentials;
use Illuminate\Support\Facades\Log;
use App\Services\Data\UserDataService;
use App\Services\Utility\Connection;
class SecurityService
{
    // checks if the user is in the databse and logs them in
    public function authenticate(Credentials $user)
    {
        Log::info("Entering SecurityService.authenticate()");
        // Open a connection using the Connection class
        $db = new Connection();
        $conn= $db->open();
        // Call the DAO to find the desired user.
        $dao = new UserDataService($conn);
        // Call findByUser() and save the results.
        $results = $dao->findByUser($user);
        // Connection is closed.
        $conn = null;
        // If the user has been suspended, return false automatically.
        if ($results['user']['ROLE'] == -1) { return false; }
        // If the search was successful, return true.
        if ($results['result'] == 1) { return true; }
        // If the search was unsuccessful, return false.
        else { return false; }
    
    }
    // adds the user to the database, effectively registering them.
    public function register(UserObjectModel $user)
    {
        Log::info("Entering SecurityService.register()");
        // Open a new connection using the Connection class.
        $db = new Connection();
        $conn = $db->open();
        // Call the DAO to register/create the user.
        $dao = new UserDataService($conn);
        // Call createUser()
        $registerSuccess = $dao->createUser($user);
        // If the registration was successful, return true.
        if ($registerSuccess == 1)
        {
            return true;
        }
        // If the registration was unsuccessful, return false.
        else
        {
            return false;
        }
    }
    
    public function checkDUP(UserObjectModel $user) {
        Log::info("Entering SecurityService.checkDUP()");
        
        // Open a connection using the Connection class
        $db = new Connection();
        $conn= $db->open();
        // Call the DAO to find the desired user.
        $dao = new UserDataService($conn);
        
        //gets the username and password from the user model
        $username = $user->username;
        $password = $user->password;
        
        //creates a credentials object
        $credentials = new Credentials($username, $password);
        // Call findByUser() and save the results.
        $results = $dao->findByUser($credentials);
        // Connection is closed.
        $conn = null;
        //if there is a matching account return false
        if ($results['result'] == 1 ) { return false; }
        //else return true
        else {return true;}
    }
}