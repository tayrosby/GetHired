<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: Job model holds attributes for a job post
 */

namespace App\Model;

class JobModel implements \JsonSerializable{
    
    //job attributes
    private $id;
    private $position;
    private $company;
    private $location;
    private $requirements;
    private $level;
    private $description;
    
    /**
     * constructor
     * @param $id
     * @param $position
     * @param $company
     * @param $location
     * @param $requirements
     * @param $level
     * @param $description
     */
    public function __construct($id, $position, $company, $location, $requirements, $level, $description) {
     
        $this->id = $id;
        $this->position = $position;
        $this->company = $company;
        $this->location = $location;
        $this->requirements = $requirements;
        $this->level = $level;
        $this->description = $description;
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
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
