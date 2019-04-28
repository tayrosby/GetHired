<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: GroupMemberController is responsible for linking the group members to groups
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\GroupMembersBusinessService;
use App\Services\Utility\ILoggerService;
use Exception;
use App\Model\GroupMemberModel;

class GroupMemberController extends Controller
{
    protected $logger;
    
    /**
     *
     * @param ILoggerService $logger
     */
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    
    /**
     * adds the group member information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addMember(Request $request){
        
        try {
            $this->logger->info("Entering GroupMemberController.addMember()");
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
                $this->logger->info("Entering GroupMemberController.addMember() with success");
                return view("allgroups");
            }
            else
            {
                $this->logger->info("Entering GroupMemberController.addMember() with failure");
                return view("allgroups");
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
     * deletes the group memeber information from the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteMember(Request $request)
    {
        try {
            $this->logger->info("Entering GroupMemberController.deleteMember()");
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
                $this->logger->info("Entering GroupMemberController.deleteMember() with success");
                return view("allgroups");
            }
            else
            {
                $this->logger->info("Entering GroupMemberController.deleteMember() with failure");
                return view("allgroups");
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
}
