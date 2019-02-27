<?php
/*
 * Authors: Taylor Rosby
 * Date: January 20, 2019
 * Description: RegisterController is responsible for connecting the Register View to the business portion of the program
 */
namespace App\Http\Controllers;
use App\Model\UserObjectModel;
use App\Model\Credentials;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class RegisterController extends Controller
{
    // register() is responsible for registering a user.
    public function register(Request $request)
    {
        try {
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        // Variables are taken from the Register view.
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $role = 0;
        
        // A user is created using the input
        $credentials = new Credentials($username, $password);
        $user = new UserObjectModel($firstName, $lastName, $credentials, $email, $role);
        
        //calls the security service
        $security = new SecurityService();
        
        //checks the database to see if the user already exists
        $duplicate = $security->checkDUP($user);
        
        //if there is a duplicate keep the user on the registration page
        if ($duplicate) {
            return view('registrationpage');
        }
        //else let the registration process continues
        else{
        // saves the result of the registration.
        $success = $security->register($user);
        
        // if register is successful, send the user to the login page
        if ($success)
        {
            return view('loginpage');
        }
        // if register is unsuccessful, keep user at the registration page
        else
        {
            return view('registrationpage');
        }
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
    
    //validates the data in the form
    private function validateForm(Request $request){
        //setup data validation rules for login form
        
        $rules = ['firstname' => 'Required | Between:3,15',
            'lastname' => 'Required | Between:2,10',
            'email' => 'Required | email',
            'username' => 'Required | Between:3,10 | Alpha',
            'password' => 'Required | Between:3,10 | alpha_num',

        ];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}