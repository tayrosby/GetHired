<?php
namespace App\Services\Data;
use PDOException;
use Illuminate\Support\Facades\Log;
use \PDO;
use App\Services\Utility\DatabaseException;
use App\Model\RequirementsModel;

class RequirementsDataService
{
    private $conn;
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Create Method
    public function createRequirement(RequirementsModel $requirements)
    {
        Log::info("Entering SkillsDataService.createSkill()");
        
        try
        {
            // Taking user info from user
            $requirement = $requirements->requirement;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO REQUIREMENTS (ID, REQUIREMENTS) VALUES (NULL, :requirement)");
            $stmt->bindParam(':requirement', $requirement);
            
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
            $stmt = $this->conn->prepare("SELECT * FROM `REQUIREMENTS`");
            $stmt->execute();
            
            $skills = [];
            
            while($skill = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($skills, $skill);
            }
            
            $stmt = null;
            
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
    public function editRequirement(RequirementsModel $requirements)
    {
        Log::info("Entering SkillsDataService.editSkill()");
        
        try
        {
            $id = $requirements->id;
            $requirement = $requirements->requirement;
            
            $stmt = $this->conn->prepare("UPDATE `REQUIREMENTS` SET `REQUIREMENTS` = :requirement WHERE `REQUIREMENTS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':requirement', $requirement);
            $stmt->execute();
            
            $count = $stmt->rowCount();
            
            $stmt = null;
            
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
    public function deleteRequirement(RequirementsModel $requirements)
    {
        Log::info("Entering SkillsDataService.deleteSkill()");
        
        try
        {
            $id = $requirements->id;
            $stmt = $this->conn->prepare("DELETE FROM `REQUIREMENTS` WHERE `REQUIREMENTS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $count = $stmt->rowCount();
            
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