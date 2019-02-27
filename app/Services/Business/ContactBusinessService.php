<?php
/*
 * Authors: Taylor Rosby and Ruben Cerrato
 * Date: January 20, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\ContactDataService;
use App\Services\Utility\Connection;
class ContactBusinessService
{
    //passes the model to the data service
    public function edit($contact)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ContactDataService($conn);
        
        //calls the edit function in the data service
        $editSuccess = $service->editContact($contact);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($editSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
    
    //passes the model to the data service
    public function create($contact)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ContactDataService($conn);
        
        //calls the create method in the data service
        $createSuccess = $service->createContact($contact);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($createSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
    
    //finds all the contacts in the data service
    public function findAll()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates a array of contacts
        $contact = Array();
        
        //calls the data service
        $service = new ContactDataService($conn);
        
        //calls the findall method in the data service
        $contact = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //return the array
        return $contact;
    }
    
    //passes the model to the data service
    public function delete($contact)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ContactDataService($conn);
        
        //calls the delete function in the data service
        $deleteSuccess = $service->deleteContact($contact);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($deleteSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
}
?>