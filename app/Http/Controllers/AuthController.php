<?php

namespace App\Http\Controllers;

use App\Http\Model\User\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Attempt login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Request $request){
        //Validate fields
        $this->validate($request,['email' => 'required|email','password'=> 'required']);

        //Attempt validation
        $credentials = $request->only(['email','password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Incorrect credentials'], 401);
        }
        return response()->json(compact('token'));
    }

    /**Register user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request){
        //Validate fields
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:255',
            'company_id' => 'required|exists:company,company_id',
            'password' => 'required|min:8|confirmed',
        ]);
        //Create user, generate token and return
        $user =  UserModel::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'company_id' => $request->input('company_id')
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }
}