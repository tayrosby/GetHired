<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 24, 2019
 * Description: SkillsDataService is responsible for handling skill related requests
 */
namespace App\Services\Data;
use PDOException;
use Illuminate\Support\Facades\Log;
use App\Model\UserSkillsModel;
use \PDO;
use App\Services\Utility\DatabaseException;

class SkillsDataService
{
    //attribute for the connection
    private $conn;
    
    //constructor
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Create Method
    public function createSkill(UserSkillsModel $skills)
    {
        Log::info("Entering SkillsDataService.createSkill()");
        
        try
        {
            // Taking user info from user
            $skillName = $skills->skillName;
            $id = $skills->id;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO SKILLS (ID, SKILL_NAME, USERS_ID) VALUES (NULL, :skillName, :id)");
            $stmt->bindParam(':skillName', $skillName);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving SkillsDataService.createSkill() with row count");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //READ Method
    public function findAll()
    {
        Log::info("Entering SkillsDataService.findAll()");
        
        try
        {
            //prepares the sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `SKILLS`");
            $stmt->execute();
            
            //create an array of skills
            $skills = [];
            
            // Fetches the skills found and pushes them to an array
            while($skill = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($skills, $skill);
            }
            
            //closes the statment
            $stmt = null;
            
            //returns skills
            Log::info("Leaving SkillsDataService.findSkill() with rowCount");
            return $skills;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // Update Method
    public function editSkill(UserSkillsModel $skills)
    {
        Log::info("Entering SkillsDataService.editSkill()");
        
        try
        {
            //takes information from the user
            $id = $skills->id;
            $skillName = $skills->skillName;
            
            //creates a statement
            $stmt = $this->conn->prepare("UPDATE `SKILLS` SET `SKILL_NAME` = :skillName WHERE `SKILLS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':skillName', $skillName);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving SkillsDataService.editSkill() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    // Delete Method
    public function deleteSkill(UserSkillsModel $skills)
    {
        Log::info("Entering SkillsDataService.deleteSkill()");
        
        try
        {
            //takes information from the user
            $id = $skills->id;
            
            //creates a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `SKILLS` WHERE `SKILLS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            Log::info("Leaving SkillsDataService.deleteSkill() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}