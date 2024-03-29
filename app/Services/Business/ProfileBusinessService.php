<?php
/*
 * Authors: Taylor Rosby
 * Date: March 16, 2019
 * Description: ProfileBusinessService is responsible for handling profile related requests.
 */
namespace App\Services\Business;
use App\Services\Data\SkillsDataService;
use App\Services\Data\ContactDataService;
use App\Services\Data\EducationDataService;
use App\Services\Data\ExperienceDataService;

use App\Services\Utility\Connection;
use App\Services\Data\UserDataService;

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
    $userService = new UserDataService($conn);
    $skillsService = new SkillsDataService($conn);
    $contactService = new ContactDataService($conn);
    $eduService = new EducationDataService($conn);
    $xpService = new ExperienceDataService($conn);
    
    //calls the get user method in the data service
    $userResult = $userService->getUser($id);
    $skillsResult = $skillsService->findSkillByID($id);
    $contactResult = $contactService->findContactByID($id);
    $eduResult = $eduService->findEducationByID($id);
    $xpResult = $xpService->findExperienceByID($id);
    
    $user = ['firstName' => $userResult['user']['FIRSTNAME'], 'lastName' => $userResult['user']['LASTNAME'] ];
    
    $result = ['user' => $user, 'skills' => $skillsResult, 'contact' => $contactResult, 'education' => $eduResult, 'experience' => $xpResult];
    //closes the connection
    $conn = null;
    
    if ($result == null){
        return false;
    }else{
        //returns the user
        return $result;
    }
}
}
