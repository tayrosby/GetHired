<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserExperienceModel;
use App\Services\Business\ExperienceBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class ExperienceController extends Controller
{
    //
    
    public function addExperience(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
            //$this->validateForm($request);
            
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        $service = new ExperienceBusinessService();
        
        $success = $service->create($experience);
        
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
        }
//         catch (ValidationException $e1){
//             //catch and rethrow the data validation exceptions (so we can catch all others in our next exception catch block)
//             throw $e1;
//         }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    
    public function editExperience(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
           // $this->validateForm($request);
            
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        $service = new ExperienceBusinessService();
        
        $success = $service->edit($experience);
        
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
        }
        }
//         catch (ValidationException $e1){
//             //catch and rethrow the data validation exceptions (so we can catch all others in our next exception catch block)
//             throw $e1;
//         }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    
    public function deleteExperience(Request $request)
    {
        try {
            
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        $service = new ExperienceBusinessService();
        
        $success = $service->delete($experience, $id);
        
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
    
    public function findAllExperience(Request $request)
    {
        try {
        $service = new ExperienceBusinessService();
        
        $success = $service->findAll();
        
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
    
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['position' => 'Required | Alpha',
            'company' => 'Required | Alpha',
            'location' => 'Required | Alpha',
            'yearsActive' => 'Required | Max:2 | Numeric',
            'duties' => 'Required | Alpha'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}