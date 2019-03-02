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
    public function addGroup(Request $request){
        
        try {

            $userID = $request->input('userID');
            $groupID = $request->input('groupID');
            
            $member = new GroupMemberModel(-1, $groupID, $userID);
            
            $service = new GroupMembersBusinessService();
            
            $success = $service->joinGroup($member);
            
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
            
            $id = $request->input('id');
            
            $service = new GroupMembersBusinessService();
            
            $success = $service->leaveGroup($id);
            
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
