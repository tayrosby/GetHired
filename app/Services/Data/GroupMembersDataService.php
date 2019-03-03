<?php
/*
 * Authors: Taylor Rosby
 * Date: Februaty 28, 2019
 * Description: GroupMembersDataService is responsible for handling group member related requests
 */
namespace App\Services\Data;

use PDO;
use PDOException;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use App\Model\GroupMemberModel;

class GroupMembersDataService {
private $conn;

//constructor
public function __construct($conn)
{
    $this->conn = $conn;
}
// Create Method
public function createMember(GroupMemberModel $member)
{
    Log::info("Entering GroupMembersDataService.createMember()");
    
    try
    {
        // Taking user info from user
        $groupid = $member->groupID;
        $userid = $member->userID;
        
        // Create SQL statement using prepare()
        $stmt = $this->conn->prepare("INSERT INTO GROUP_MEMBERS (ID, GROUPS_ID, USERS_ID) VALUES (NULL, :groupid, :userid)");
        $stmt->bindParam(':groupid', $groupid);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        // Save the row count
        $count = $stmt->rowCount();
        // Close the statement
        $stmt = null;
        // Return the number of rows that were affected
        Log::info("Leaving GroupMembersDataService.createMember() with row count");
        return $count;
    }
    catch(PDOException $e)
    {
        Log::error("Exception: ", array("message" => $e->getMessage()));
        throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
    }
}

// Delete Method
public function deleteMember(GroupMemberModel $member)
{
    Log::info("Entering GroupMembersDataService.deleteMember()");
    
    try
    {
        $groupid = $member->groupID;
        $userid = $member->userID;
        // prepares a SQL statement to delete a user. the delete is based on matching IDs
        $stmt = $this->conn->prepare("DELETE FROM GROUP_MEMBERS WHERE GROUPS_ID = :groupid AND USERS_ID = :userid");
        $stmt->bindParam(':groupid', $groupid);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        //saves the row count
        $count = $stmt->rowCount();
        //close the statement
        $stmt = null;
        //return the number of rows that were affected
        Log::info("Leaving GroupMembersDataService.deleteMember() with rowCount");
        return $count;
    }
    catch(PDOException $e)
    {
        Log::error("Exception: ", array("message" => $e->getMessage()));
        throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
    }
}
}
