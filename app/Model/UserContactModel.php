<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserContactModel holds attributes for a contact in the profile
 */
namespace App\Model;

class UserContactModel implements \JsonSerializable
{
    //contact attributes
    private $id;
    private $phoneNumber;
    private $email;
    private $city;
    private $state;
    
    //constructor
    /**
     * 
     * @param $id
     * @param $phoneNumber
     * @param $email
     * @param $city
     * @param $state
     */
    public function __construct($id, $phoneNumber, $email, $city, $state)
    {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->city = $city;
        $this->state = $state;
    }
    
    // Getter
    /**
     * 
     * @param $property
     * @return $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
?>
