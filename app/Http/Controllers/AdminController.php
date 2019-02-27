<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: AdminController is responsible for linking the AdminPage to
 * the business side of the program.
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\Business\UserBusinessService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Model\Credentials;
use App\Model\UserObjectModel;

class AdminController extends Controller
{
    // Goes from the navbar to the AdminPage
    public function index()
    {
        try {
        // Calls the business service
        $service = new UserBusinessService();
        // Gets all the users in the database
        $users = $service->getAll();
        // Puts the users in an associative array
        $data = ['users' => $users];
        // Return to the Admin page with the data
        return view("adminpage")->with($data);
        } 
    
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        Log::error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return ($data);
    }
    }
    // Suspends the user by setting their role to -1
    public function suspendUser(Request $request)
    {
        try {
            // Takes the user's id
            $ID = $request->input('ID');
            // Calls the business service
            $service = new UserBusinessService();
            // suspends the user
            $service->suspend($ID);
            // redirects to the admin page
            return redirect("/admin");
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    // Deletes the user
    public function deleteUser(Request $request)
    {
        try {
        // Takes the user's id
        $ID = $request->input('ID');
        // Calls the business service
        $service = new UserBusinessService();
        // deletes the user based on their id
        $service->delete($ID);
        // redirects to the admin page
        return redirect("/admin");
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