<?php
/*
 * Authors: Taylor Rosby
 * Date: March 16, 2019
 * Description: profileRestController is responsible for showing a profile over an api
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DTO; 
use Exception;
use App\Services\Business\ProfileBusinessService;
use App\Services\Utility\ILoggerService;

class ProfileRestController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $this->logger->info("Entering ProfileRestController.show()");
            //call service to get users by ID
            $service = new ProfileBusinessService();
            $profile = $service->getProfileByID($id);
            
            //create DTO
            if($profile == null){
                $dto = new DTO(404, "Profile Not Found", "");
            }
            else{
                $dto = new DTO(200, "OK", $profile);
                
            }
            
            //serialize the dto to json
            $json = json_encode($dto);
            
            //return json back to caller
            $this->logger->info("Exiting ProfileRestController.show()");
            return $json;
            
        }
        catch (Exception $e){
            //log exception
            $this->logger->error("Exception : ", array("message" => $e->getMessage()));
            //return an error back to the user in the DTO
            $dto = new DTO(-2, $e->getMessage(), "");
            return json_encode($dto);
        }
    }

}

