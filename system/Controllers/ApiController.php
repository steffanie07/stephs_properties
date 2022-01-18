<?php

namespace App\Controllers;

/**
 * @author Stephanie Boms <steffanie07@gmail.com>
 * @package Assignment
 */
use App\Models\ApiData;
use App\Controllers\Validator as Validator;

class ApiController
{
    use Validator;

    public function index()
    {
    	return $this->http_request();
    }


 /**
     * http_request
     * @property AUTHORIZATIONS: APIKey API_PREFIX
     * @property Content-Type: application/json
     * @property REQUEST BODY SCHEMA: application/json
     * @property Accept application/json
     * @param $response this holds the return data from ifobip
     * @param $data we convert $response to an array so we can use it's properties
     * @return $this->sendInfobipOTP
     * @param  mixed $url
     * @param  mixed $message
     * @return $data
     */
    private function http_request()
    {
    	$url = "https://trial.craig.mtcserver15.com/api/properties/?api_key=2S7rhsaq9X1cnfkMCPHX64YsWYyfe1he";
    	$verb ="GET";
       
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $verb,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true); 
    
        return ApiData::store($data['data']);
    }


}












