<?php
/*
 * Authors: Taylor Rosby
 * Date: February 27, 2019
 * Description: GroupController is responsible for linking the addgroups to
 * the business side of the program.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Model\GroupModel;
use App\Services\Business\GroupBusinessService;

class GroupController extends Controller
{
    /**
     * adds the group information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addGroup(Request $request){
        
        try {
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
            $groupName = $request->input('groupName');
            $groupDescription = $request->input('groupDescription');
            $interest = $request->input('interest');
            $userID = $request->input('userID');
            
            //creates a group model
            $group = new GroupModel(-1, $groupName, $groupDescription, $interest, $userID);
            
            //calls the business service
            $service = new GroupBusinessService();
            
            //passes the model to the add method in the business service
            $success = $service->addGroup($group);
            
            //fail or succeed return to all groups
            if($success)
            {
                return view("allgroups");
            }
            else
            {
                return view("addgroups");
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
     * edits the group information in the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editGroups(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
            $this->validateForm($request);
            
            //takes information from the user
            $id = $request->input('id');
            $groupName = $request->input('groupName');
            $groupDescription = $request->input('groupDescription');
            $interest = $request->input('interest');
            $userID = $request->input('userID');
            
            //creates a group model
            $group = new GroupModel($id, $groupName, $groupDescription, $interest, $userID);
            
            //calls the business service
            $service = new GroupBusinessService();
            
            //passes the model to the update method in the business service
            $success = $service->updateGroup($group);
            
            //fail or succeed return to all groups
            if($success)
            {
                return view("managegroups");
            }
            else
            {
                return view("managegroups");
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
     * deletes the group information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteGroups(Request $request)
    {
        try {
            //takes information from the user
            $id = $request->input('id');
            
            //calls the business service
            $service = new GroupBusinessService();
            
            //passes the model to the delete method in the business service
            $success = $service->deleteGroup($id);
            
            //fail or succeed return to all groups
            if($success)
            {
                return view("managegroups");
            }
            else
            {
                return view("managegroups");
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
     * finds all the groups in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllGroups(Request $request)
    {
        try {
            //calls the business service
            $service = new GroupBusinessService();
            
            //calls the find all method in the business service
            $success = $service->findAllGroups();
            
            //fail or succeed return to all groups
            if($success)
            {
                return view("allgroups");
            }
            else
            {
                return view("allgroups");
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
     * validates the form data
     * @param Request $request
     */
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['groupName' => 'Required | Between:5,25',
            'groupDescription' => 'Required | Between:5,250',
            'interest' => 'Required | Between:5,25'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}

