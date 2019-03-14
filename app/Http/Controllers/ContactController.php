<?php
/*
 * Authors: Taylor Rosby
 * Date: February 24, 2019
 * Description: ContactController is responsible for linking the contact information in the profile
 * the business side of the program.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserContactModel;
use App\Services\Business\ContactBusinessService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class ContactController extends Controller
{

    /**
     * /adds the contact information to the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function addContact(Request $request)
    {
        try {
            
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        //takes information from the user
        $id = $request->input('id');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $city = $request->input('city');
        $state = $request->input('state');
        
        //creates a new contact object
        $contact = new UserContactModel($id, $phoneNumber, $email, $city, $state);
        
        //calls the contact business service
        $service = new ContactBusinessService();
        
        //sends the contact object to the create method in the business service
        $success = $service->addContacts($contact);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
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
    
    /**
     * edits the contact information in the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function editContact(Request $request)
    {
        try {
            
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        //takes information from the user
        $id = $request->input('id');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $city = $request->input('city');
        $state = $request->input('state');
        
        //creates a contact object
        $contact = new UserContactModel($id, $phoneNumber, $email, $city, $state);
        
        //calls the business service
        $service = new ContactBusinessService();
        
        //sends the contact object to the edit method in the business service
        $success = $service->editContacts($contact);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
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
    
    /**
     * deleted the contact in the database
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function deleteContact(Request $request)
    {
        try {
        //validate the form data(will redirect back to login view if errors)
        $this->validateForm($request);
        
        //takes information from the user
        $id = $request->input('id');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $city = $request->input('city');
        $state = $request->input('state');
        
        //creates a contact object
        $contact = new UserContactModel($id, $phoneNumber, $email, $city, $state);
        
        //calls the business service
        $service = new ContactBusinessService();
        
        //sends the contact object to the delete method in the business service
        $success = $service->deleteContacts($contact);
        
        //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
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
    
    /**
     * finds all the contacts in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|NULL[]
     */
    public function findAllContact(Request $request)
    {
        try {
        
            //calls the business service
        $service = new ContactBusinessService();
        
        //calls the findAll method in the business service
        $success = $service->findAllContacts();
        
       //if it fails or succeeds return to the profile page
        if($success)
        {
            return view("profilepage");
        }
        else
        {
            return view("profilepage");
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
    
    /**
     * validates the data in the form
     * @param Request $request
     */
     private function validateForm(Request $request){
        //setup data validation rules for form
        
        $rules = ['phoneNumber' => 'Required | Between:1,11 | Numeric',
            'email' => 'Required | email',
            'city' => 'Required | Between:5,50',
            'state' => 'Required | Between:5,50'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}
