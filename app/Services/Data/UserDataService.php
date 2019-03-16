<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserDataService is responsible for handling User related requests
 */
namespace App\Services\Data;
use PDO;
use PDOException;
use App\Model\UserObjectModel;
use App\Model\Credentials;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;

class UserDataService
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
     * Read Method
     * @param Credentials $user
     * @throws DatabaseException
     * @return array
     */
    public function findByUser(Credentials $user)
    {
        Log::info("Entering UserDAO.findByUser()");
        
        try
        {
            // Take credentials from the user
            $username = $user->username;
            $password = $user->password;
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare('SELECT * FROM USERS WHERE BINARY USERNAME = :username AND BINARY PASSWORD = :password');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Save the row count
            $count = $stmt->rowCount();
            // Puts the user and rowCount in an array
            $result = ['result' => $count, 'user' => $user];
            // Close the statement
            $stmt = null;
            // Return the result array
            Log::info("Leaving UserDAO.findByUser() with result");
            return $result;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Create Method
     * @param UserObjectModel $user
     * @throws DatabaseException
     * @return $count - row count
     */
    public function createUser(UserObjectModel $user)
    {
        Log::info("Entering UserDAO.createUser()");
        
        try
        {
            // Taking user info from user
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            $email = $user->email;
            $username = $user->credential->username;
            $password = $user->credential->password;
            $role = 0;
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO USERS (ID, FIRSTNAME, LASTNAME, EMAIL, USERNAME, PASSWORD, ROLE) VALUES (NULL, :firstName, :lastName, :email, :username, :password, :role)");
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            Log::info("Leaving UserDAO.createUser() with row count");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * update method
     * @param $id
     * @throws DatabaseException
     * @return $count - row count
     */
    public function updateUser($id)
    {
        Log::info("Entering UserDAO.suspendUser()");
        
        try
        {
            //creates the sql statement
            $stmt = $this->conn->prepare("UPDATE `USERS` SET `ROLE` = -1 WHERE `USERS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            //save the row count
            $count = $stmt->rowCount();
            //close the statement
            $stmt = null;
            //return the number of rows that were affected
            Log::info("Leaving UserDAO.suspendUser() with rowCount");
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
     * @param $id
     * @throws DatabaseException
     * @return $count - row count
     */
    public function deleteUser($id)
    {
        Log::info("Entering UserDAO.deleteUser()");
        
        try
        {
            // prepares a SQL statement to delete a user. the delete is based on matching IDs
            $stmt = $this->conn->prepare("DELETE FROM USERS WHERE ID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            //saves the row count
            $count = $stmt->rowCount();
            //close the statement
            $stmt = null;
            //return the number of rows that were affected
            Log::info("Leaving UserDAO.deleteUser() with rowCount");
            return $count;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Returns a single user based on their ID
     * @param $id
     * @throws DatabaseException
     * @return NULL[]
     */
    public function getUser($id)
    {
        Log::info("Entering UserDAO.getUser()");
        
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `USERS` WHERE `USERS`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            // Stores the results of the SELECT in an associative array
            // The user is taken from the statement through a fetch()
            $results = ['result' => $stmt->rowCount(), 'user' => $stmt->fetch(PDO::FETCH_ASSOC)];
            
            //returns the results
            return $results;
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Gets every user in the database
     * @throws DatabaseException
     * @return array
     */
    public function findAll()
    {
        Log::info("Entering UserDAO.getAll()");
        
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `USERS`");
            $stmt->execute();
            
            //creates an array of users
            $users = [];
            // Fetches the users found and pushes them to an array
            while($user = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($users, $user);
            }
            //closes the statement
            $stmt = null;
            //returns the number of users
            return $users;
            
        }
        catch(PDOException $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
