<?php
/*
 * Authors: Taylor Rosby and Ruben Cerrato
 * Date: January 20, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\ExperienceDataService;
use App\Services\Utility\Connection;
class ExperienceBusinessService
{
    
    //passes the model to the data service
    public function edit($experience)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ExperienceDataService($conn);
        
        //calls the edit function in the data service
        $editSuccess = $service->editExperience($experience);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($editSuccess == 1) { return true; }
        //else return false
        else { return false; }
    }
    
    //passes the model to the data service
    public function create($experience)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ExperienceDataService($conn);
        
        //calls the create function in the data service
        $createSuccess = $service->createExperience($experience);
        
        //closes the connection
        $conn = null;
        //if successful return true
        if ($createSuccess == 1) { return true; }
        //else return false
        else { return false; }
    }
    
    public function findAll()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of experience
        $experience = Array();
        
        //calls the data service
        $service = new ExperienceDataService($conn);
        
        //calls the findall function in the data service
        $experience = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //returns the experience array
        return $experience;
    }
    
    //passes the model to the data service
    public function delete($experience, $id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new ExperienceDataService($conn);
        
        //calls the delete function in the data service
        $deleteSuccess = $service->deleteExperience($experience, $id);
        
        //closes the connection
        $conn = null;
        //if successful return true
        if ($deleteSuccess == 1) { return true; }
        //else return false
        else { return false; }
    }
}
?>