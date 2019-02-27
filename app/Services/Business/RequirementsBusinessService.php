<?php
/*
 * Authors: Taylor Rosby and Ruben Cerrato
 * Date: January 20, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\RequirementsDataService;
use App\Services\Utility\Connection;

class RequirementsBusinessService
{
    public function edit($requirements)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new RequirementsDataService($conn);
        $editSuccess = $service->editRequirement($requirements);
        
        $conn = null;
        if ($editSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function create($requirements)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new RequirementsDataService($conn);
        $createSuccess = $service->createRequirement($requirements);
        
        $conn = null;
        if ($createSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function findAll()
    {
        $db = new Connection();
        $conn = $db->open();
        
        $skills = Array();
        
        $service = new RequirementsDataService($conn);
        $skills = $service->findAll();
        
        $conn = null;
        
        return $skills;
    }
    
    public function delete($requirements)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new RequirementsDataService($conn);
        $deleteSuccess = $service->deleteRequirement($requirements);
        
        $conn = null;
        if ($deleteSuccess == 1) { return true; }
        else { return false; }
    }
}
?>