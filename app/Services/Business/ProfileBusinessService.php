<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: UserBusinessService is responsible for handling User related requests.
 */
namespace App\Services\Business;
use App\Services\Data\SkillsDataService;
use App\Services\Data\ContactDataService;
use App\Services\Data\EducationDataService;
use App\Services\Data\ExperienceDataService;

use App\Services\Utility\Connection;

class ProfileBusinessService
{
/**
 * gets a user from the database based on id
 * @param $id
 * @return NULL[]
 */
public function getProfileByID($id)
{
    //creates a connection
    $db = new Connection();
    $conn = $db->open();
    
    //calls the data service
    $skillsService = new SkillsDataService($conn);
    $contactService = new ContactDataService($conn);
    $eduService = new EducationDataService($conn);
    $xpService = new ExperienceDataService($conn);
    
    //calls the get user method in the data service
    $skillsResult = $skillsService->findSkillByID($id);
    $contactResult = $contactService->findContactByID($id);
    $eduResult = $eduService->findEducationByID($id);
    $xpResult = $xpService->findExperienceByID($id);
    
    $result = ['skills' => $skillsResult, 'contact' => $contactResult, 'education' => $eduResult, 'experience' => $xpResult];
    //closes the connection
    $conn = null;
    
    //returns the user
    return $result;
}
}
