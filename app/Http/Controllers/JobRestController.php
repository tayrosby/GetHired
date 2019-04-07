<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\JobBusinessService;
use App\Models\DTO;
use Exception;

class JobRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try {
            //call service to get all users
            $service = new JobBusinessService();
            $jobs = $service->findAllJobs();
            
            //create DTO
            if($jobs == null){
                $dto = new DTO(404, "User Not Found", "");
            }
            else{
                $dto = new DTO(200, "OK", $jobs);
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
            $service = new JobBusinessService();
            $job = $service->findJobByID($id);
            
            //create DTO
            if($job == null){
                $dto = new DTO(404, "Job Not Found", "");
            }
            else{
                $dto = new DTO(200, "OK", $job);
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
