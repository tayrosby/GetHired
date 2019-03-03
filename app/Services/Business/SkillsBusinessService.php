<?php
/*
 * Authors: Taylor Rosby
 * Date: January 20, 2019
 * Description: SkillsBusinessService is responsible for handling Skill related requests.
 */
namespace App\Services\Business;
use App\Services\Data\SkillsDataService;
use App\Services\Utility\Connection;
class SkillsBusinessService
{
    //passes the model to the data service
    public function editSkills($skills)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new SkillsDataService($conn);
        $editSuccess = $service->editSkill($skills);
        
        $conn = null;
        if ($editSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function addSkills($skills)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new SkillsDataService($conn);
        $createSuccess = $service->createSkill($skills);
        
        $conn = null;
        if ($createSuccess == 1) { return true; }
        else { return false; }
    }
    
    public function findAllSkills()
    {
        $db = new Connection();
        $conn = $db->open();
        
        $skills = Array();
        
        $service = new SkillsDataService($conn);
        $skills = $service->findAll();
        
        $conn = null;

        return $skills;
    }
    
    public function deleteSkills($skills)
    {
        $db = new Connection();
        $conn = $db->open();
        
        $service = new SkillsDataService($conn);
        $deleteSuccess = $service->deleteSkill($skills);
        
        $conn = null;
        if ($deleteSuccess == 1) { return true; }
        else { return false; }
    }
}
?>
