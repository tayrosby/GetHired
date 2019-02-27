<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserContactModel holds attributes for a contact in the profile
 */
namespace App\Model;

class UserContactModel
{
    //contact attributes
    private $id;
    private $phoneNumber;
    private $email;
    private $city;
    private $state;
    
    //constructor
    public function __construct($id, $phoneNumber, $email, $city, $state)
    {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->city = $city;
        $this->state = $state;
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>