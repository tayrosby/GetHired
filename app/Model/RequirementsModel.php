<?php
namespace App\Model;

class RequirementsModel
{
    private $id;
    private $requirement;
    
    
    public function __construct($id, $requirement)
    {
        $this->id = $id;
        $this->requirement = $requirement;
        
    }
    
    // Getter
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}
?>