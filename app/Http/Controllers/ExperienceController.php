<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: ExperienceController is responsible for linking the experience information in the profile
 * the business side of the program.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserExperienceModel;
use App\Services\Business\ExperienceBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class ExperienceController extends Controller
{   
    /**
     * adds the experience information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addExperience(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
           // $this->validateForm($request);
           
            //takes info from the user
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        //creates an experience object
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        //calls the business service
        $service = new ExperienceBusinessService();
        
        //passes the model to add method in the business service
        $success = $service->addExperience($experience);
        
        //fail or succeed return to profile page
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
            return view('exception')->with($data);
        }
    }
    
    /**
     * edits the experience information in the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editExperience(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
           // $this->validateForm($request);
            
            //takes info from the user
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        //creates an experience object
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        //calls the business service
        $service = new ExperienceBusinessService();
        
        //passes the model to edit method in the business service
        $success = $service->editExperience($experience);
        
        //fail or succeed return to profile page
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
            return view('exception')->with($data);
        }
    }
    
    /**
     * deletes the experience information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteExperience(Request $request)
    {
        try {
            
            //takes info from the user
        $id = $request->input('id');
        $position = $request->input('position');
        $company = $request->input('company');
        $location = $request->input('location');
        $yearsActive = $request->input('yearsActive');
        $duties = $request->input('duties');
        
        //creates an experience object
        $experience = new UserExperienceModel($id, $position, $company, $location, $yearsActive, $duties);
        
        //calls the business service
        $service = new ExperienceBusinessService();
        
        //passes the model to delete method in the business service
        $success = $service->deleteExperience($experience, $id);
        
        //fail or succeed return to profile page
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
            return view('exception')->with($data);
        }
    }
    
    /**
     * finds all the experience information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllExperience(Request $request)
    {
        try {
            //calls the business service
        $service = new ExperienceBusinessService();
        
        //calls the find all method in the business service
        $success = $service->findAllExperience();
        
        //fail or succeed return to profile page
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
            return view('exception')->with($data);
        }
    }
    
    /**
     * validates the data in the form
     * @param Request $request
     */
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['position' => 'Required | Between:5,50',
            'company' => 'Required | Between:4,50',
            'location' => 'Required | Between:5,50',
            'yearsActive' => 'Required | Between:1,2 | Numeric',
            'duties' => 'Required | Between:5,50'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
