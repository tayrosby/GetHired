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
    
    /**
     * constructor
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Create Method
     * @param UserSkillsModel $skills
     * @throws DatabaseException
     * @return $count - row count
     */
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
    
    /**
     * READ Method
     * @throws DatabaseException
     * @return array
     */
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
    
    /**
     * Update Method
     * @param UserSkillsModel $skills
     * @throws DatabaseException
     * @return $count - row count
     */
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
    
    /**
     * Delete Method
     * @param UserSkillsModel $skills
     * @throws DatabaseException
     * @return $count - row count
     */
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
    
    /**
     * 
     * @param $id
     * @throws DatabaseException
     * @return NULL|\App\Model\UserSkillsModel
     */
    public function findSkillByID($id) {
        try {
            Log::info("Entering SkillsDataService.deleteSkill()");
            
            //select all users
            $sth = $this->conn->prepare('SELECT * FROM SKILLS WHERE USERS_ID = :id');
            $sth->bindParam(':id', $id);
            $sth->execute();
            
            //return an array of users
            if($sth->rowCount() == 0){
                Log::info("Leaving SkillsDataService.deleteSkill() with 0 rowCount");
                return null;
            }
            else {
                
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                $skill = new UserSkillsModel($row["ID"], $row["SKILL_NAME"]);
                
                Log::info("Leaving SkillsDataService.deleteSkill() with skill");
                return $skill;
            }
        } catch (PDOException $e) {
            //BEST PRACTICE Catch all exceptions (do not swallow exceptions), log the exception,
            //do not throw technology specific exceptions, and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
