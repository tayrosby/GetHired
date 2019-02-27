<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: JobController is responsible for linking the job information in the profile
 * the business side of the program.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\JobModel;
use App\Services\Business\JobBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class JobController extends Controller
{
    //adds the job information to the database
    public function addJob(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);

            //takes information from the user
            $position = $request->input('position');
            $company = $request->input('company');
            $location = $request->input('location');
            $requirements = $request->input('requirements');
            $level = $request->input('level');
            $description = $request->input('description');
            
            //creates a new job object
            $job = new JobModel(-1, $position, $company, $location, $requirements, $level, $description);
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //sends the job object to the create method in the business service
            $success = $service->create($job);
            
            //if it succeeds take the admin to manage jobs
            if($success)
            {
                return view("managejobs");
            }
            //if it fails stay on add jobs
            else
            {
                return view("addjobs");
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
    
    //edits the job information to the database
    public function editJob(Request $request)
    {
        try {
            
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
            $id = $request->input('id');
            $position = $request->input('position');
            $company = $request->input('company');
            $location = $request->input('location');
            $requirements = $request->input('requirements');
            $level = $request->input('level');
            $description = $request->input('description');
            
            //creates a new job object
            $job = new JobModel($id, $position, $company, $location, $requirements, $level, $description);
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //sends the job object to the edit method in the business service
            $success = $service->edit($job);
            
            //if it fails or succeeds return to the manage jobs
            if($success)
            {
                return view("managejobs");
            }
            else
            {
                return view("managejobs");
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
    
    //deletes the delete information to the database
    public function deleteJob(Request $request)
    {
        try {
            //takes information from the user
            $id = $request->input('ID');
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //sends the job id to the delete method in the business service
            $success = $service->delete($id);
            
            //if it fails or succeeds return to the manage jobs
            if($success)
            {
                return view("managejobs");
            }
            else
            {
                return view("managejobs");
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
    
    //finds all the job information to the database
    public function findAllJob(Request $request)
    {
        try {
            //calls the job business service
            $service = new JobBusinessService();
            
            //calls the findAll method in the business service
            $jobs = $service->findAll();
            
            //puts the results into an associate array
            $data = ['jobs' => $jobs];
            
            //if there are jobs go to manage view with the data
            if($jobs)
            {
                return view("managejobs")->with($data);
            }
            //else just go to manage view
            else
            {
                return view("managejobs");
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
        
        $rules = ['position' => 'Required | Alpha',
            'company' => 'Required | Alpha',
            'location' => 'Required | Alpha',
            'requirements' => 'Required | alpha_dash',
            'level' => 'Required | Max:10 | Alpha',
            'description' => 'Required | alpha_dash'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}