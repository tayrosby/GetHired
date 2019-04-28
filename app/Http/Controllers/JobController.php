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
use App\Services\Utility\ILoggerService;
use Illuminate\Validation\ValidationException;
use Exception;

class JobController extends Controller
{
    /**
     *
     * @param ILoggerService $logger
     */
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    
    /**
     * adds the job information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addJob(Request $request)
    {
        try {
            $this->logger->info("Entering JobController.addJob()");
            //validate the form data(will redirect back to login view if errors)
            //$this->validateForm($request);

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
            $success = $service->addJob($job);
            
            //if it succeeds take the admin to manage jobs
            if($success)
            {
                $this->logger->info("Exiting JobController.addJob() with success");
                return redirect("/managejob");
            }
            //if it fails stay on add jobs
            else
            {
                $this->logger->info("Exiting JobController.addJob() with failure");
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
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
            
        }
        
    }
    
    /**
     * edits the job information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editJob(Request $request)
    {
        try {
            $this->logger->info("Entering JobController.editJob()");
            //validate the form data(will redirect back to login view if errors)
           // $this->validateForm($request);
            
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
            $success = $service->editJob($job);
            
            //if it fails or succeeds return to the manage jobs
            if($success)
            {
                $this->logger->info("Exiting JobController.editJob() with success");
                return redirect("/managejob");
            }
            else
            {
                $this->logger->info("Exiting JobController.editJob() with failure");
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
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
            
        }
    }
    
    /**
     * deletes the delete information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteJob(Request $request)
    {
        try {
            $this->logger->info("Entering JobController.deleteJob()");
            //takes information from the user
            $id = $request->input('ID');
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //sends the job id to the delete method in the business service
            $success = $service->deleteJobs($id);
            
            //if it fails or succeeds return to the manage jobs
            if($success)
            {
                $this->logger->info("Exiting JobController.deleteJob() with success");
                return view("managejobs");
            }
            else
            {
                $this->logger->info("Exiting JobController.deleteJob() with failure");
                return view("managejobs");
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
     * finds all the job information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllJob(Request $request)
    {
        try {
            $this->logger->info("Entering JobController.findAllJob()");
            //calls the job business service
            $service = new JobBusinessService();
            
            //calls the findAll method in the business service
            $jobs = $service->findAllJobs();
            
            //puts the results into an associate array
            $data = ['jobs' => $jobs];
            
            //if there are jobs go to manage view with the data
            if($jobs)
            {
                $this->logger->info("Exiting JobController.findAllJob() with success");
                return view("managejobs")->with($data);
            }
            //else just go to manage view
            else
            {
                $this->logger->info("Exiting JobController.findAllJob() with failure");
                return view("managejobs");
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
     * finds all the jobs matching the search term in the description
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findJobByDescription(Request $request){
        try {
            $this->logger->info("Entering JobController.findJobByDescription()");
            //takes information from the user
            $description = $request->input('descriptionSearch');
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //calls the find by dscription method in the business service
            $jobs = $service->findJobByDescription($description);
            
            //creates an array of jobs
            // Puts the users in an associative array
            $data = ['jobs' => $jobs];
            
            //if there are jobs to to a search results page
            if($jobs){
                $this->logger->info("Exiting JobController.findJobByDescription() with success");
                return view("jobresults")->with($data);
            }
            //else return a jobs not found page
            {
                $this->logger->info("Exiting JobController.findJobByDescription() with failure");
                return view("jobresults");
            }           
            
        }
        catch (Exception $e) {
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
            
        }
        
    }
    
    /**
     * finds a job based on a matching id
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findJobByID(Request $request){
        try {
            $this->logger->info("Entering JobController.findJobByID()");
            //takes information from the user
            $id = $request->input('id');
            
            //calls the job business service
            $service = new JobBusinessService();
            
            //calls the find by dscription method in the business service
            $jobs = $service->findJobByID($id);
            
            //creates an array of jobs
            // Puts the users in an associative array
            $data = ['jobs' => $jobs];
            
            $this->logger->info("Exiting JobController.findJobByID()");
            return view("jobdetails")->with($data);
            
        }
        catch (Exception $e) {
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
        
        $rules = ['position' => 'Required | Between:5,50',
            'company' => 'Required | Between:5,50',
            'location' => 'Required | Between:5,50',
            'requirements' => 'Required | Between:5,50',
            'level' => 'Required | Between:5,50',
            'description' => 'Required | Between:5,250',
            'descriptionSearch' => 'Required | Between:5,50'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
