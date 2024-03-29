<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: SkillsController is responsible for linking the skills information in the profile
 * the business side of the program.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserSkillsModel;
use App\Services\Business\SkillsBusinessService;
use App\Services\Utility\ILoggerService;
use Illuminate\Validation\ValidationException;
use Exception;

class SkillsController extends Controller
{
    /**
     *
     * @param ILoggerService $logger
     */
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    
    /**
     * adds skill information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addSkill(Request $request)
    {
        try {
            $this->logger->info("Entering SkillsController.addSkill()");
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
            $skillName = $request->input('skillName');
            $id = $request->input('user_id');
            
            //creates a skills object
            $skills = new UserSkillsModel($id, $skillName);
            
            //calls the business service
            $service = new SkillsBusinessService();
            
            //passes the model to the add method in the business service
            $success = $service->addSkills($skills);
            
            //fail or succeed return to the profile page
            if($success)
            {
                $this->logger->info("Exiting SkillsController.addSkill() with success");
                return view("profilepage");
            }
            else
            {
                $this->logger->info("Exiting SkillsController.addSkill() with failure");
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
     * edit skill information in the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editSkill(Request $request)
    {
        try {
            $this->logger->info("Entering SkillsController.editSkill()");
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
            $skillName = $request->input('skillName');
            $id = $request->input('id');
            
            //creates a skills object
            $skills = new UserSkillsModel($id, $skillName);
            
            //calls the business service
            $service = new SkillsBusinessService();
            
            //passes the model to the edit method in the business service
            $success = $service->editSkills($skills);
            
            //fail or succeed return to the profile page
            if($success)
            {
                $this->logger->info("Exiting SkillsController.editSkill() with success");
                return view("profilepage");
            }
            else
            {
                $this->logger->info("Exiting SkillsController.editSkill() with failure");
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
     * delete skill information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteSkill(Request $request)
    {
        try {
            $this->logger->info("Entering SkillsController.deleteSkill()");
            //takes information from the user
            $skillName = $request->input('skillName');
            $id = $request->input('id');
            
            //creates a skills object
            $skills = new UserSkillsModel($id, $skillName);
            
            //calls the business service
            $service = new SkillsBusinessService();;
            
            //passes the model to the delete method in the business service
            $success = $service->deleteSkills($skills);
            
            //fail or succeed return to the profile page
            if($success)
            {
                $this->logger->info("Exiting SkillsController.deleteSkill() with success");
                return view("profilepage");
            }
            else
            {
                $this->logger->info("Exiting SkillsController.deleteSkill() with failure");
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
     * finds all the skills in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllSkill(Request $request)
    {
        try {
            $this->logger->info("Entering SkillsController.findAllSkill()");
            //calls the business service
            $service = new SkillsBusinessService();
            
            //calls the find all method in the business service
            $success = $service->findAllSkills();
            
            //fail or succeed return to the profile page
            if($success)
            {
                $this->logger->info("Exiting SkillsController.findAllSkill() with success");
                return view("profilepage");
            }
            else
            {
                $this->logger->info("Exiting SkillsController.findAllSkill() with failure");
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
     * validates the form data
     * @param Request $request
     */
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['skillName' => 'Required | Between:2,29'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
