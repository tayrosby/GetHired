<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DTO;
use Exception;
use App\Services\Business\ProfileBusinessService;

class ProfileRestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //call service to get users by ID
            $service = new ProfileBusinessService();
            $profile = $service->getProfileByID($id);
            
            //create DTO
            if($profile == null){
                $dto = new DTO(-1, "User Not Found", "");
            }
            else{
                $dto = new DTO(0, "OK", $profile);
            }
            
            //serialize the dto to json
            $json = json_encode($dto);
            
            //return json back to caller
            return $json;
            
        }
        catch (Exception $e){
            //log exception
            //MyLogger2::error("Exception : ", array("message" => $e->getMessage()));
            //return an error back to the user in the DTO
            $dto = new DTO(-2, $e->getMessage(), "");
            return json_encode($dto);
        }
    }

}
