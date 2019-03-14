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
    /**
     * passes the model to the data service
     * @param $skills
     * @return boolean
     */
    public function editSkills($skills)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new SkillsDataService($conn);
        
        //calls the edit method in the data service
        $editSuccess = $service->editSkill($skills);
        
        //closes the connection
        $conn = null;
        
        //if successful return true, else return false
        if ($editSuccess == 1) { return true; }
        else { return false; }
    }
    
    /**
     * passes the model to the data service
     * @param $skills
     * @return boolean
     */
    public function addSkills($skills)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new SkillsDataService($conn);
        
        //calls the create method in the data service
        $createSuccess = $service->createSkill($skills);
        
        //closes the connection
        $conn = null;
        
        //if successful return true, else return false
        if ($createSuccess == 1) { return true; }
        else { return false; }
    }
    
    /**
     * finds all the skills in the data service
     * @return array
     */
    public function findAllSkills()
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of skills
        $skills = Array();
        
        //calls the data service
        $service = new SkillsDataService($conn);
        
        //calls the find all method in the data service
        $skills = $service->findAll();
        
        //closes the connection
        $conn = null;

        //returns array
        return $skills;
    }
    
    /**
     * passes the model to the data service
     * @param $skills
     * @return boolean
     */
    public function deleteSkills($skills)
    {
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new SkillsDataService($conn);
        
        //calls the delete method in the data service
        $deleteSuccess = $service->deleteSkill($skills);
        
        //closes the connection
        $conn = null;
        
        //if successful return true, else return false
        if ($deleteSuccess == 1) { return true; }
        else { return false; }
    }
}
?>
