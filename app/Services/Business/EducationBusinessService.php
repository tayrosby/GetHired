<?php
/*
 * Authors: Taylor Rosby and Ruben Cerrato
 * Date: January 20, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\EducationDataService;
use App\Services\Utility\Connection;
class EducationBusinessService
{
    //passes the model to the data service
    public function edit($education)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new EducationDataService($conn);
        
        //sends the model to the edit function in the data service
        $editSuccess = $service->editEducation($education);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($editSuccess == 1) { return true; }
        
        //else return false
        else { return false; }
    }
    
    //passes the model to the data service
    public function create($education)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new EducationDataService($conn);
        
        //sends the model to the create function in the data service
        $createSuccess = $service->createEducation($education);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($createSuccess == 1) { return true; }
        //else return false
        else { return false; }
    }
    
    //finds all the education in the database
    public function findAll()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of education
        $education = Array();
        
        //calls the data service
        $service = new EducationDataService($conn);
        
        //calls the find all method in the data service
        $education = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //return the array
        return $education;
    }
    
    //passes the model to the data service
    public function delete($education, $id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new EducationDataService($conn);
        
        //sends the model to the delete function in the data service
        $deleteSuccess = $service->deleteEducation($education, $id);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($deleteSuccess == 1) { return true; }
        
        //else return false
        else { return false; }
    }
}
?>