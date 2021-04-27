<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use http\Exception;

class RegisterController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User Registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function register(Request $request)
    {
        //get user data
        $data = $request->all();
        $image = $request->file('image');

        $result = ['status'=>200];
        try{
            //create user
            $user =  $this->userService->registerUser($data,$image);
            $token = $user->createToken('TinyTwitterSystemAuth')->accessToken;

            $result['data'] = $user;
            $result['token'] = $token;

        }catch(\Exception $e){
            $result = [
                'status'=>500,
                'error'=>$e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
}
