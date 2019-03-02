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
    //
    public function addGroup(Request $request){
        
        try {
            //validate the form data(will redirect back to login view if errors)
            //$this->validateForm($request);
            
            $groupName = $request->input('groupName');
            $groupDescription = $request->input('groupDescription');
            $interest = $request->input('interest');
            $userID = $request->input('userID');
            
            $group = new GroupModel(-1, $groupName, $groupDescription, $interest, $userID);
            
            $service = new GroupBusinessService();
            
            $success = $service->addGroup($group);
            
            if($success)
            {
                return view("allgroups");
            }
            else
            {
                return view("addgroup");
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
    
    public function editGroups(Request $request)
    {
        try {
            //validate the form data(will redirect back to login view if errors)
           // $this->validateForm($request);
            
            $id = $request->input('id');
            $groupName = $request->input('groupName');
            $groupDescription = $request->input('groupDescription');
            $interest = $request->input('interest');
            $userID = $request->input('userID');
            
            $group = new GroupModel($id, $groupName, $groupDescription, $interest, $userID);
            
            $service = new GroupBusinessService();
            
            $success = $service->updateGroup($group);
            
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
            return ($data);
        }
    }
    
    public function deleteGroups(Request $request)
    {
        try {
            
            $id = $request->input('id');
            
            $service = new GroupBusinessService();
            
            $success = $service->deleteGroup($id);
            
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
            return ($data);
        }
    }
    
    public function findAllGroups(Request $request)
    {
        try {
            $service = new GroupBusinessService();
            
            $success = $service->findAll();
            
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
