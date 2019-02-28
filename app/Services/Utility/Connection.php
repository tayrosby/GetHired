<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: Connections holds the database information
 */
namespace App\Services\Utility;
use Illuminate\Support\Facades\Log;
use PDO;
class Connection
{
    // Servername
    private $sn;
    // Username
    private $un;
    // Password
    private $pw;
    // Database name
    private $db;
    
    // Open() is in charge of creating a connection to the database.
    public function open()
    {
        // Parameters are taken from the config file.
        $this->sn = config("database.connections.mysql.host");
        $this->un = config("database.connections.mysql.username");
        $this->pw = config("database.connections.mysql.password");
        $this->db = config("database.connections.mysql.database");

        // A new PDO is opened using information from the config file.
        $conn = new PDO("mysql:host=$this->sn;dbname=$this->db", $this->un, $this->pw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(!$conn){
           Log::error("Connection Error: ", array("message" => $e->getMessage())); 
        }
        else {
        // The connection is returned.
        return $conn;
        }
    }
}
?>
