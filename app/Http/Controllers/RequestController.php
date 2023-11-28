<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    use ApiResponseTrait;
    /**
     * Capture Any Request and store it
     */
    public function capture(Origin $origin, Request $request){
        // Check if Origin is deleted
        if($origin->trashed() || $origin->forceService->trashed()){
            return $this->respondError("This endpoint was disabled");
        }
        // Create the Request Data to Fill
        $data['request_url'] = $request->fullUrl();
        $data['request_ip'] = $request->getClientIp();
        $data['request_data'] = $request->all();
        $data['request_query_string'] = [];
        parse_str($request->getQueryString(), $data['request_query_string']);
        $data['request_body'] = $request->post();
        $data['body_raw'] = $request->getContent();
        $data['request_headers'] = collect($request->header())->map(function($header){
            return $header[0];
        })->toArray();
        $data['request_detail'] = $request->server();
        $data['status'] = 'authorized';
        $data['request_method'] = $request->method();

        $auth = [];

        // Get the authorization data
        if($request->header('Authorization')){
            $auth = explode(' ',$request->header('Authorization'));
        }
        // Check the Origin Auth to the request values
        if($origin->auth_type == 'domain_user_password'){
            if($auth[0] != 'Basic')
                $data['status'] = 'unauthorized';

            //Base64 decode user and pass and service
            $credentials = explode(':',base64_decode($auth[1]));
            $userService = explode('/',$credentials[0]);

            if($userService[0] != $origin->auth_config['domain'] || $userService[1] != $origin->auth_config['user'] || $credentials[1] != $origin->auth_config['password'])
                $data['status'] = 'unauthorized';

        }elseif($origin->auth_type == 'user_password'){
            if($auth[0] != 'Basic')
                $data['status'] = 'unauthorized';

            //Base 64 decode user and pass
            $credentials = explode(':',base64_decode($auth[1]));
            if($credentials[0] != $origin->auth_config['user'] || $credentials[1] != $origin->auth_config['password'])
                $data['status'] = 'unauthorized';

        }elseif($origin->auth_type == 'bearer_token'){
            if($auth[0] != 'Bearer')
                $data['status'] = 'unauthorized';

            // Check Bearer
            if($auth[1] != $origin->auth_config['bearer'])
                $data['status'] = 'unauthorized';

        }elseif($origin->auth_type == 'other'){
            $expectedHeaders = json_decode($origin->auth_config['headersJson'],true);

            $diffAssoc = array_diff_assoc($expectedHeaders, $data['request_headers']);

            if(count($diffAssoc))
                $data['status'] = 'unauthorized';

        }

        // Save this request
        $origin->requests()->create($data);

        if($data['status'] == 'authorized')
            return $this->respondSuccess("Request Authorized and Stores Successfully");

        return $this->respondError("Unauthorized");

    }

    public function getImage(Request $request){
        return Storage::response($request->path());
    }

}
