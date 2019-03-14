<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserEducationModel holds the attributes for education in the profile
 */
namespace App\Model;

class UserEducationModel
{
    //attributes
    private $id;
    private $schoolName;
    private $degree;
    private $graduationYear;
    
    /**
     * constructor
     * @param $id
     * @param $schoolName
     * @param $degree
     * @param $graduationYear
     */
    public function __construct($id, $schoolName, $degree, $graduationYear)
    {
        $this->id = $id;
        $this->schoolName = $schoolName;
        $this->degree = $degree;
        $this->graduationYear = $graduationYear;
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
