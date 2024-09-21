<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function succesResponse($message='',$data=null,$code =200){
        $response = [
            'status' => true,
            'message' => $message,
            'data'=> $data
        ];
        return response()->json($response,$code);
    }

    function failedResponse($message='',$data=null,$code =404){
        $response = [
            'status' => false,
            'message' => $message,
            'data'=> $data
        ];
        return response()->json($response,$code);
    }
}
