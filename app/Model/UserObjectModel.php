<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserObjectModel holds attributes for a user
 */
namespace App\Model;

class UserObjectModel
{
    //attributes
    private $firstName;
    private $lastName;
    private $credential;
    private $email;
    private $role;

    /**
     * constructor
     * @param $firstName
     * @param $lastName
     * @param $credential
     * @param $email
     * @param $role
     */
    public function __construct($firstName, $lastName, $credential, $email, $role)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->credential = $credential;
        $this->email = $email;
        $this->role = $role;
    }
    
    /**
     * Getter
     * @param $property
     * @return $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>
