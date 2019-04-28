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
use App\Services\Utility\ILoggerService;
use Exception;

class AdminController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    /**
     * Goes from the navbar to the AdminPage
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function index()
    {
        try {
        $this->logger->info("Entering AdminController.index()");
        // Calls the business service
        $service = new UserBusinessService();
        // Gets all the users in the database
        $users = $service->getAllUsers();
        // Puts the users in an associative array
        $data = ['users' => $users];
        // Return to the Admin page with the data
        $this->logger->info("Exiting AdminController.index()");
        return view("adminpage")->with($data);
        } 
    
    catch (Exception $e){
        //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
        //log the exception and display exception view
        $this->logger->error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return ($data);
    }
    }
    
    /**
     * Suspends the user by setting their role to -1
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|NULL[]
     */
    public function suspendUser(Request $request)
    {
        try {
            $this->logger->info("Entering AdminController.suspendUser()");
            // Takes the user's id
            $id = $request->input('ID');
            // Calls the business service
            $service = new UserBusinessService();
            // suspends the user
            $service->suspendUser($id);
            // redirects to the admin page
            $this->logger->info("Exiting AdminController.suspendUser()");
            return redirect("/admin");
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }

    /**
     * Deletes the user
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|NULL[]
     */
    public function deleteUser(Request $request)
    {
        try {
        $this->logger->info("Entering AdminController.deleteUser()");
        // Takes the user's id
        $id = $request->input('ID');
        // Calls the business service
        $service = new UserBusinessService();
        // deletes the user based on their id
        $service->deleteUser($id);
        // redirects to the admin page
        $this->logger->info("Exiting AdminController.deleteUser()");
        return redirect("/admin");
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
}
