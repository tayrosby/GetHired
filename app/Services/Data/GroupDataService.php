<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 28, 2019
 * Description: GroupDataService is responsible for handling group related requests
 */
namespace App\Services\Data;

use PDOException;
use Illuminate\Support\Facades\Log;
use \PDO;
use App\Services\Utility\DatabaseException;
use App\Model\GroupModel;

class GroupDataService 
{
    private $conn;
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    // Create Method
    public function createGroup(GroupModel $group)
    {
        Log::info("Entering GroupDataService.createGroup()");
        
        try
        {
            // Taking user info from user
            $groupName = $group->groupName;
            $groupDescription = $group->groupDescription;
            $interest = $group->interest;
            $userID = $group->userID;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO `GROUPS` (ID, GROUP_NAME, GROUP_DESCRIPTION, INTEREST, USERS_ID) VALUES (NULL, :groupName, :groupDescription, :interest, :usersid)");
            $stmt->bindParam(':groupName', $groupName);
            $stmt->bindParam(':groupDescription', $groupDescription);
            $stmt->bindParam(':interest', $interest);
            $stmt->bindParam(':usersid', $userID);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving GroupDataService.createGroup() with row count");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //READ Method
    public function findAllGroups()
    {
        Log::info("Entering GroupDataService.findAllGroups()");
        
        try
        {
            //prepares the sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `GROUPS`");
            $stmt->execute();
            
            //creates an array of jobs
            $jobs = [];
            
            //fetched the jobs and pushes them into ann array
            while($job = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($jobs, $job);
            }
            
            //closes the statement
            $stmt = null;
            
            //returns the jobs
            Log::info("Leaving GroupDataService.findAllGroups() with rowCount");
            return $jobs;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // Update Method
    public function editGroup(GroupModel $group)
    {
        Log::info("Entering GroupDataService.editGroups()");
        
        try
        {
            // Taking user info from user
            $id = $group->id;
            $groupName = $group->groupName;
            $groupDescription = $group->groupDescription;
            $interest = $group->interest;
            
            //creates a sql statement
            $stmt = $this->conn->prepare("UPDATE `GROUPS` SET `GROUP_NAME` = :groupName, `GROUP_DESCRIPTION` = :groupDescription, `INTEREST` = :interest WHERE `GROUPS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':groupName', $groupName);
            $stmt->bindParam(':groupDescription', $groupDescription);
            $stmt->bindParam(':interest', $interest);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving GroupDataService.editGroups() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // Delete Method
    public function deleteGroup($id)
    {
        Log::info("Entering GroupDataService.deleteGroups()");
        
        try
        {
            //creates a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `GROUPS` WHERE `GROUPS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving GroupDataService.deleteGroups() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
}
