<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: GroupMemberController is responsible for linking the group members to groups
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\GroupMembersBusinessService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Model\GroupMemberModel;

class GroupMemberController extends Controller
{
    //
    public function addMember(Request $request){
        
        try {
            //takes information from the user
            $userID = $request->input('userID');
            $groupID = $request->input('groupID');
            
            //creates a new member object
            $member = new GroupMemberModel(-1, $groupID, $userID);
            
            //calls the group members business service
            $service = new GroupMembersBusinessService();
            
            //sends the member object to the join group method in the business service
            $success = $service->joinGroup($member);
            
            //if it fails or succeeds return to the all groups
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
    
    public function deleteMember(Request $request)
    {
        try {
            //takes information from the user
            $id = $request->input('id');
            $userID = $request->input('userID');
            $groupID = $request->input('groupID');
            
            //creates a new member object
            $member = new GroupMemberModel($id, $groupID, $userID);
            
            //calls the group members business service
            $service = new GroupMembersBusinessService();
            
            //sends the member object to the join group method in the business service
            $success = $service->leaveGroup($member);
            
            //if it fails or succeeds return to the all groups
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
}

