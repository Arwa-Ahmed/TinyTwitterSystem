<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    /**
     * Get a validator for a login request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);
    }
    /**
     * Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        //validation
        $validator = $this->validator($data);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()], 422);
        }
        if(auth()->attempt($data)){
            $token = auth()->user()->createToken('TinyTwitterSystemAuth')->accessToken;

            return  response()->json(['token'=>$token],200);

        }else{
            return  response()->json(['error'=>'Invalid Email or password'],401);
        }
    }
}
