<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\Business\RequirementsBusinessService;
use App\Model\RequirementsModel;

class RequirementsController extends Controller
{
    public function addSkill(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            $requirement = $request->input('requirement');
            
            $requirements = new RequirementsModel(-1, $requirement);
            
            $service = new RequirementsBusinessService();
            
            $success = $service->create($requirements);
            
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
    
    public function editRequirement(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            $requirement = $request->input('requirement');
            $id = $request->input('id');
            
            $requirements = new RequirementsModel($id, $requirement);
            
            $service = new RequirementsBusinessService();
            
            $success = $service->edit($requirements);
            
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
    
    public function deleteRequirement(Request $request)
    {
        try {
            $requirement = $request->input('requirement');
            $id = $request->input('id');
            
            $requirements = new RequirementsModel($id, $requirement);
            
            $service = new RequirementsBusinessService();
            
            $success = $service->delete($requirements);
            
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
    
    public function findAllRequirement(Request $request)
    {
        try {
            $service = new RequirementsBusinessService();
            
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
        
        $rules = ['requirement' => 'Required | Alpha'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
