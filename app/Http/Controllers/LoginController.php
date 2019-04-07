<?php
/*
 * Authors: Taylor Rosby
 * Date: January 20, 2019
 * Description: LoginController is responsible for connecting the Login View to the business portion
 * of the program
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Credentials;
use App\Services\Business\SecurityService;
use App\Services\Utility\ILoggerService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class LoginController extends Controller
{
    
    protected $logger;
    
    public function __construct(ILoggerService $logger){
        $this->logger = $logger;
    }
    
    /**
     * authenticate() is responsible for authenticating the user.
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function authenticate(Request $request)
    {
    try {
        $this->logger->info("Entering LoginController.authenticate()");
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        // display the form data
        $username = $request->input("username");
        $password = $request->input("password");
        
        $this->logger->info("Parameters are: ",array('username' => $username, 'password' => $password));
        $user = new Credentials($username, $password);
        $instance = new SecurityService();
        // sends the info from the form to the authenticate method in security method
        $success = $instance->authenticate($user);
        // if login is successful, send the user back to the home page
        
        $request->session()->put('userID', $success['user']['ID']);
        
        $request->session()->put('role', $success['user']['ROLE']);

        if ($success)
        {
            $this->logger->info("Exit LoginController::index() with login passing");
            return view('homepage');
        }
        // if login is unsuccessful, keep user at the login page
        else
        {
            $this->logger->info("Exit LoginController::index() with login failing");
            return view('loginpage');
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
        return ($data);
        }
    }
    
    /**
     * deletes the session information to log out the user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function logout(Request $request) 
    {
        $this->logger->info("Entering LoginController.logout()");
        $request->session()->forget('userID');
        $this->logger->info("Exiting LoginController.logout()");
        return view('homepage');
    }
    
    /**
     * validates the form data
     * @param Request $request
     */
    private function validateForm(Request $request){
        $this->logger->info("Entering LoginController.validateForm()");
          //setup data validation rules for login form
        
        $rules = ['username' => 'Required | Between:3,10',
                  'password' => 'Required | Between:3,10 | alpha_num'];
        
        //run data validation rules
        $this->validate($request, $rules);
        $this->logger->info("Exiting LoginController.validateForm()");
    }
    
}
