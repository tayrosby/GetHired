<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: Credentials holds the username and password for login
 */
namespace App\Model;
class Credentials
{
    //member variables
    private $username;
    private $password;
    
    //constructor
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>