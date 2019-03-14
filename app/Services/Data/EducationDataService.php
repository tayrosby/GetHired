<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 24, 2019
 * Description: EducationDataService is responsible for handling education related requests
 */
namespace App\Services\Data;
use PDOException;
use Illuminate\Support\Facades\Log;
use App\Model\UserEducationModel;
use \PDO;
use App\Services\Utility\DatabaseException;

class EducationDataService
{
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
     * @param UserEducationModel $education
     * @throws DatabaseException
     * @return $count - row count
     */
    public function createEducation(UserEducationModel $education)
    {
        Log::info("Entering EducationDataService.createEducation()");
        
        try
        {
            // Taking user info from user
            $id = $education->id;
            $schoolName = $education->schoolName;
            $degree = $education->degree;
            $graduationYear = $education->graduationYear;  
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO EDUCATION (ID, SCHOOL_NAME, DEGREE, GRADUATION_YEAR, USERS_ID) VALUES (NULL, :schoolName, :degree, :graduationYear, :id)");
            $stmt->bindParam(':schoolName', $schoolName);
            $stmt->bindParam(':degree', $degree);
            $stmt->bindParam(':graduationYear', $graduationYear);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving EducationDataService.createEducation() with row count");
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
        Log::info("Entering EducationDataService.findEducation()");
        
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `EDUCATION`");
            $stmt->execute();
            
            //creates an array of education
            $edus = [];
            
            //fetched the education and pushes it onto an array
            while($edu = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($edus, $edu);
            }
            
            //closes the connection
            $stmt = null;
            
            //returns the education
            Log::info("Leaving EducationDataService.findEducation() with rowCount");
            return $edus;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Update Method
     * @param UserEducationModel $education
     * @throws DatabaseException
     * @return $count - row count
     */
    public function editEducation(UserEducationModel $education)
    {
        Log::info("Entering EducationDataService.editEducation()");
        
        try
        {
            //takes information from the user
            $id = $education->id;
            $schoolName = $education->schoolName;
            $degree = $education->degree;
            $graduationYear = $education->graduationYear;  
            
            //prepares a sql statement
            $stmt = $this->conn->prepare("UPDATE `EDUCATION` SET `SCHOOL_NAME` = :schoolName, `DEGREE` = :degree, `GRADUATION_YEAR` = :graduationYear WHERE `EDUCATION`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':schoolName', $schoolName);
            $stmt->bindParam(':degree', $degree);
            $stmt->bindParam(':graduationYear', $graduationYear);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving EducationDataService.editEducation() with rowCount");
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
     * @param UserEducationModel $education
     * @param $id
     * @throws DatabaseException
     * @return $count - row count
     */
    public function deleteEducation(UserEducationModel $education, $id)
    {
        Log::info("Entering EducationDataService.deleteEducation()");
        
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `EDUCATION` WHERE `EDUCATION`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving EducationDataService.deleteEducation() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
