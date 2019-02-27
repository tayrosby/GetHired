<?php
/*
 * Authors: Taylor Rosby and Ruben Cerrato
 * Date: Februaty 09, 2019
 * Description: ContactDataService is responsible for handling contact related requests
 */
namespace App\Services\Data;
use PDOException;
use Illuminate\Support\Facades\Log;
use App\Model\UserContactModel;
use \PDO;
use App\Services\Utility\DatabaseException;

class ContactDataService
{
    //attribute for the connection
    private $conn;
    
    //constructor
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Create Method
    public function createContact(UserContactModel $contact)
    {
        Log::info("Entering ContactDataService.createContact()");
        
        try
        {
            // Taking user info from user
            $phoneNumber = $contact->phoneNumber;
            $email = $contact->email;
            $city = $contact->city;
            $state = $contact->state;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO CONTACT (ID, PHONE_NUMBER, EMAIL_ADDRESS, CITY, STATE, USERS_ID) VALUES (NULL, :phoneNumber, :email, :city, :state, :id)");
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving ContactDataService.createContact() with row count");
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
        Log::info("Entering ContactDataService.findContact()");
        
        try
        {
            //preapres a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `CONTACT`");
            $stmt->execute();
            
            //creates an array of contact
            $contacts = [];
            
            // Fetches the contacts found and pushes them to an array
            while($contact = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($contacts, $contact);
            }
            
            //closes the statement
            $stmt = null;
            
            //returns the contacts
            Log::info("Leaving ContactDataService.findContact() with rowCount");
            return $contacts;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // Update Method
    public function editContact(UserContactModel $contact)
    {
        Log::info("Entering ContactDataService.editContact()");
        
        try
        {
            //takes info from the user
            $id = $contact->id;
            $phoneNumber = $contact->phoneNumber;
            $email = $contact->email;
            $city = $contact->city;
            $state = $contact->state;
            
            //prepares a sql statement
            $stmt = $this->conn->prepare("UPDATE `CONTACT` SET `PHONE_NUMBER` = :phoneNumber, `EMAIL_ADDRESS` = :email, `CITY` = :city, `STATE` = :state WHERE `CONTACT`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving ContactDataService.editContact() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    // Delete Method
    public function deleteContact(UserContactModel $contact)
    {
        Log::info("Entering ContactDataService.deleteContact()");
        
        try
        {
            //takes information from users
            $id = $contact->id;
            
            //prepares a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `CONTACT` WHERE `CONTACT`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            Log::info("Leaving ContactDataService.deleteContact() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
       
    }
}