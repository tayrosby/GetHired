<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: EducationController is responsible for linking the education information in the profile
 * the business side of the program.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserEducationModel;
use App\Services\Business\EducationBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class EducationController extends Controller
{
    //adds the education information to the database
    public function addEducation(Request $request)
    {
        try { 
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
        
            //takes information from the user
        $id = $request->input("user_id");
        $schoolName = $request->input('schoolName');
        $degree = $request->input('degree');
        $graduationYear = $request->input('graduationYear');
        
        //creates a new education object
        $education = new UserEducationModel($id, $schoolName, $degree, $graduationYear);
        
        //calls the education business service
        $service = new EducationBusinessService();
        
        //sends the education object to the create method in the business service
        $success = $service->addEducation($education);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
        }
        catch (ValidationException $e1){
            //catch and rethrow the data validation exceptions (so we can catch all others in our next exception catch block)
            throw $e1;
        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    
    //edits the education information to the database
    public function editEducation(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
        $id = $request->input('id');
        $schoolName = $request->input('schoolName');
        $degree = $request->input('degree');
        $graduationYear = $request->input('graduationYear');
        
        //creates a new education object
        $education = new UserEducationModel($id, $schoolName, $degree, $graduationYear);
        
        //calls the education business service
        $service = new EducationBusinessService();
        
        //sends the education object to the edit method in the business service
        $success = $service->editEducation($education);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
    }
    catch (ValidationException $e1){
            //catch and rethrow the data validation exceptions (so we can catch all others in our next exception catch block)
            throw $e1;
        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    
    //deletes the education information to the database
    public function deleteEducation(Request $request)
    {
        try {
            
            //takes information from the user
        $id = $request->input('id');
        $schoolName = $request->input('schoolName');
        $degree = $request->input('degree');
        $graduationYear = $request->input('graduationYear');
        
        //creates a new education object
        $education = new UserEducationModel($id, $schoolName, $degree, $graduationYear);
        
        //calls the education business service
        $service = new EducationBusinessService();
        
        //sends the education object to the delete method in the business service
        $success = $service->deleteEducation($education, $id);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
    }
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        Log::error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return ($data);
    }
    }
    
    //finds all the education information to the database
    public function findAllEducation(Request $request)
    {
        try {
        
            //calls the education business service
        $service = new EducationBusinessService();
        
        //calls the findAll method in the business service
        $success = $service->findAllEducation();
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
    }
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        Log::error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return ($data);
    }
        
    }
    
    //validates the data in the form
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['schoolName' => 'Required | Between:3,150 | Alpha',
            'degree' => 'Required | Between:3,150 | Alpha',
            'graduationYear' => 'Required | Numeric'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
