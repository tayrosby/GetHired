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
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class LoginController extends Controller
{
    
    // authenticate() is responsible for authenticating the user.
    public function authenticate(Request $request)
    {
    try {
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        // display the form data
        $username = $request->input("username");
        $password = $request->input("password");
        $user = new Credentials($username, $password);
        $instance = new SecurityService();
        // sends the info from the form to the authenticate method in security method
        $success = $instance->authenticate($user);
        // if login is successful, send the user back to the home page
        if ($success)
        {
            return view('homepage');
        }
        // if login is unsuccessful, keep user at the login page
        else
        {
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
        Log::error("Exception: ", array("message" => $e->getMessage()));
        $data = ['errorMSG' => $e->getMessage()];
        return ($data);
        }
    }
    
    private function validateForm(Request $request){
          //setup data validation rules for login form
        
        $rules = ['username' => 'Required | Between:3,10 | Alpha',
                  'password' => 'Required | Between:3,10'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
}