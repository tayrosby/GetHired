<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: JobBusinessService is responsible for handling Job related requests.
 */
namespace App\Services\Business;
use App\Services\Data\JobDataService;
use App\Services\Utility\Connection;

class JobBusinessService
{
    //passes the model to the data service
    public function editJob($job)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new JobDataService($conn);
        
        //calls the edit function in the data service
        $editSuccess = $service->editJob($job);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($editSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
    
    //passes the model to the data service
    public function addJob($job)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new JobDataService($conn);
        
        //calls the create function in the data service
        $createSuccess = $service->createJob($job);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($createSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
    
    public function findAllJobs()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of jobs
        $jobs = Array();
        
        //calls the data service
        $service = new JobDataService($conn);
        
        //calls the find all methos in the data service
        $jobs = $service->findAll();
        
        //closes the connection
        $conn = null;
        
        //returns the array
        return $jobs;
    }
    
    //passes the model to the data service
    public function deleteJobs($id)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new JobDataService($conn);
        
        //calls the delete function in the data service
        $deleteSuccess = $service->deleteJob($id);
        
        //closes the connection
        $conn = null;
        
        //if successful return true
        if ($deleteSuccess == 1) { return true; }
        //else return flase
        else { return false; }
    }
}
?>
