<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 24, 2019
 * Description: ExperienceDataService is responsible for handling experience related requests
 */
namespace App\Services\Data;
use PDOException;
use Illuminate\Support\Facades\Log;
use App\Model\UserExperienceModel;
use \PDO;
use App\Services\Utility\DatabaseException;

class ExperienceDataService
{
    private $conn;
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Create Method
    public function createExperience(UserExperienceModel $experience)
    {
        Log::info("Entering ExperienceDataService.createExperience()");
        
        try
        {
            // Taking user info from user
            $position = $experience->position;
            $company = $experience->company;
            $location = $experience->location;
            $yearsActive = $experience->yearsActive;
            $duties = $experience->duties;
            $id = $experience->id;
            
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO EXPERIENCE (ID, POSITION, COMPANY, LOCATION, YEARS_ACTIVE, DUTIES, USERS_ID) VALUES (NULL, :position, :company, :location, :yearsActive, :duties, :id)");
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':yearsActive', $yearsActive);
            $stmt->bindParam(':duties', $duties);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving ExperienceDataService.createExperience() with row count");
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
        Log::info("Entering ExperienceDataService.findExperience()");
        
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `EXPERIENCE`");
            $stmt->execute();
            
            //creates an array of experience
            $xps = [];
            
            //fetches the experience and pushes it into an array
            while($xp = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($xps, $xp);
            }
            
            //closes the connection
            $stmt = null;
            
            //return sthe experience
            Log::info("Leaving ExperienceDataService.findExperience() with rowCount");
            return $xps;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // Update Method
    public function editExperience(UserExperienceModel $experience)
    {
        Log::info("Entering ExperienceDataService.editExperience()");
        
        try
        {
            //takes info from the user
            $id = $experience->id;
            $position = $experience->position;
            $company = $experience->company;
            $location = $experience->location;
            $yearsActive = $experience->yearsActive;
            $duties = $experience->duties;

            //prepares the sql statement
            $stmt = $this->conn->prepare("UPDATE `EXPERIENCE` SET `POSITION` = :position, `COMPANY` = :company, `LOCATION` = :location, `YEARS_ACTIVE` = :yearsActive, `DUTIES` = :duties WHERE `EXPERIENCE`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':yearsActive', $yearsActive);
            $stmt->bindParam(':duties', $duties);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving ExperienceDataService.editExperience() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    // Delete Method
    public function deleteExperience(UserExperienceModel $experience, $id)
    {
        Log::info("Entering ExperienceDataService.deleteExperience()");
        
        try
        {
            //prepares the sql statement
            $stmt = $this->conn->prepare("DELETE FROM `EXPERIENCE` WHERE `EXPERIENCE`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving ExperienceDataService.deleteExperience() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}