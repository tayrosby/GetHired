<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 24, 2019
 * Description: JobDataService is responsible for handling job related requests
 */
namespace App\Services\Data;

use PDOException;
use Illuminate\Support\Facades\Log;
use \PDO;
use App\Services\Utility\DatabaseException;
use App\Model\JobModel;

class JobDataService {
    
    private $conn;
    
    /**
     * 
     * @param $conn - connection to the database
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /**
     * Create Method
     * @param JobModel $job
     * @throws DatabaseException
     * @return $count - the number of affected rows
     */
    public function createJob(JobModel $job)
    {
        Log::info("Entering JobDataService.createJob()");
        
        try
        {
            // Taking user info from user        
            $position = $job->position;
            $company = $job->company;
            $location = $job->location;
            $requirements = $job->requirements;
            $level = $job->level;
            $description = $job->description;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO `JOB` (ID, POSITION, COMPANY, LOCATION, REQUIREMENTS, LEVEL, DESCRIPTION ) VALUES (NULL, :position, :company, :location, :requirements, :level, :description)");
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':requirements', $requirements);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':description', $description);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving JobDataService.createJob() with row count");
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
        Log::info("Entering JobDataService.findJob()");
        
        try
        {
            //prepares the sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `JOB`");
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
            Log::info("Leaving JobDataService.findJob() with rowCount");
            return $jobs;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Update Method
     * @param JobModel $job
     * @throws DatabaseException
     * @return $count - nummber of affected rows
     */
    public function editJob(JobModel $job)
    {
        Log::info("Entering JobDataService.editJob()");
        
        try
        {
            // Taking user info from user
            $id = $job->id;
            $position = $job->position;
            $company = $job->company;
            $location = $job->location;
            $requirements = $job->requirements;
            $level = $job->level;
            $description = $job->description;
            
            //creates a sql statement
            $stmt = $this->conn->prepare("UPDATE `JOB` SET `POSITION` = :position, `COMPANY` = :company, `LOCATION` = :location, `REQUIREMENTS` = :requirements, `LEVEL` = :level, `DESCRIPTION` = :description WHERE `JOB`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':requirements', $requirements);
            $stmt->bindParam(':level', $level);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving JobDataService.editJob() with rowCount");
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
     * @param  $id - the id of the job in the database
     * @throws DatabaseException
     * @return $count - number of affected rows
     */
    public function deleteJob($id)
    {
        Log::info("Entering JobDataService.deleteJob()");
        
        try
        {
            //creates a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `JOB` WHERE `JOB`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving JobDataService.deleteJob() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    /**
     * searches the database for a job matching the search term
     * @param $description - a term in the description used to search
     * @throws DatabaseException
     * @return array
     */
    public function findJobByDescription($description) 
    {
        Log::info("Entering JobDataService.findJobByDescription()");
        
        try {
            //creates a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM JOB WHERE DESCRIPTION LIKE :description");
            $stmt->bindParam(':description', $description);
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
            Log::info("Leaving JobDataService.findJobByDescription() with rowCount");
            return $jobs;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
