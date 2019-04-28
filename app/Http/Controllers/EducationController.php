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
use App\Services\Utility\ILoggerService;
use Illuminate\Validation\ValidationException;
use Exception;

class EducationController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    
    /**
     * adds the education information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addEducation(Request $request)
    {
        try { 
            $this->logger->info("Entering EducationController.addEducation()");
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
            $this->logger->info("Exiting EducationController.addEducation() with success");
            return view("profilepage");
        }
        else
        {
            $this->logger->info("Exiting EducationController.addEducation() with failure");
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
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * edits the education information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editEducation(Request $request)
    {
        try {
            $this->logger->info("Entering EducationController.editEducation()");
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
            $this->logger->info("Exiting EducationController.editEducation() with success");
            return view("profilepage");
        }
        else
        {
            $this->logger->info("Exiting EducationController.editEducation() with failure");
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
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    /**
     * deletes the education information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteEducation(Request $request)
    {
        try {
            $this->logger->info("Entering EducationController.deleteEducation()");
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
            $this->logger->info("Exiting EducationController.deleteEducation() with success");
            return view("profilepage");
        }
        else
        {
            $this->logger->info("Exiting EducationController.deleteEducation() with failure");
            return view("profilepage");
        }
    }
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        $this->logger->error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return view('exception')->with($data);
    }
    }
    
    /**
     * finds all the education information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllEducation(Request $request)
    {
        try {
            $this->logger->info("Entering EducationController.findAllEducation()");
        
            //calls the education business service
        $service = new EducationBusinessService();
        
        //calls the findAll method in the business service
        $success = $service->findAllEducation();
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            $this->logger->info("Exiting EducationController.findAllEducation() with success");
            return view("profilepage");
        }
        else
        {
            $this->logger->info("Exiting EducationController.findAllEducation() with failure");
            return view("profilepage");
        }
    }
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        $this->logger->error("Exception: ", array("message" => $e->getMessage()));
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
        
        $rules = ['schoolName' => 'Required | Between:3,150',
            'degree' => 'Required | Between:3,150',
            'graduationYear' => 'Required | Between:4,4 | Numeric'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
}
