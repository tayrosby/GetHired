<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserSkillsModel;
use App\Services\Business\SkillsBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class SkillsController extends Controller
{
    //
    public function addSkill(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
        $skillName = $request->input('skillName');
        $id = $request->input('user_id');
        
        $skills = new UserSkillsModel($id, $skillName);
        
        $service = new SkillsBusinessService();
        
        $success = $service->create($skills);
        
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
    
    public function editSkill(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
        $skillName = $request->input('skillName');
        $id = $request->input('id');
        
        $skills = new UserSkillsModel($id, $skillName);
        
        $service = new SkillsBusinessService();
        
        $success = $service->edit($skills);
        
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
    
    public function deleteSkill(Request $request)
    {
        try {
        $skillName = $request->input('skillName');
        $id = $request->input('id');
        
        $skills = new UserSkillsModel($id, $skillName);
        
        $service = new SkillsBusinessService();;
        
        $success = $service->delete($skills);
        
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
    
    public function findAllSkill(Request $request)
    {   
        try {
        $service = new SkillsBusinessService();
        
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
        
        $rules = ['skillName' => 'Required | Between:2,29 | Alpha'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
