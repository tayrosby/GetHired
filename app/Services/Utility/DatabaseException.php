<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: DatabaseException returns if an error occurs
 */
namespace App\Services\Utility;
use Exception;
class DatabaseException
{
    
    // Non-Default constructor
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        // Call super class
        parent::__construct($message, $code, $previous);
    }
}
?>