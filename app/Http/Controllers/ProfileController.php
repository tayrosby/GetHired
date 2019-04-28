<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\ProfileBusinessService;
use Illuminate\Support\Facades\Log;
use Exception;

class ProfileController extends Controller
{
    public function showProfile()
    {
        try {
            // Takes the user's id
            $id = session('userID');
            // Calls the business service
            $service = new ProfileBusinessService();
            
            $profile = $service->getProfileByID($id);
            
            $data = ['profile' => $profile];
            // redirects to the profile page
            return view("profilepage")->with($data);
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return ($data);
        }
    }
    
    public function showProfileAdmin(Request $request)
    {
        try {
            // Takes the user's id
            $id = $request->input('ID');
            // Calls the business service
            $service = new ProfileBusinessService();
            
            $profile = $service->getProfileByID($id);
            
            $data = ['profile' => $profile];
            // redirects to the profile page
            return view("profilepage")->with($data);
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
