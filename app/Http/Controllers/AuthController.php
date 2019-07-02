<?php

namespace App\Http\Controllers;

use App\Http\Model\User\UserInterface;
use App\Http\Model\Company\CompanyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private $userRepo;
    private $companyRepo;

    public function __construct(UserInterface $userRepo,
                                CompanyInterface $companyRepo)
    {
        $this->userRepo=$userRepo;
        $this->companyRepo=$companyRepo;
    }


    public function authenticate(Request $request){
        $this->validate($request,['email' => 'required|email','password'=> 'required']);

        $credentials = $request->only(['email','password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Incorrect credentials'], 401);
        }
        return response()->json(compact('token'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'company_name'=>'required',
            'company_email'=>'required|email|max:255|unique:company',
            'company_phone'=>'required',
            'company_cep'=>'required',
            'company_tax_id'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|max:255',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $company=$this->companyRepo->createCompany([
            'company_name'=>$request->input('company_name'),
            'company_email'=>$request->input('company_email'),
            'company_phone'=>$request->input('company_phone'),
            'company_cep'=>$request->input('company_cep'),
            'company_tax_id'=>$request->input('company_tax_id')
            ]);
        
        $user =  $this->userRepo->createUser([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'company_id' => $company->company_id
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

                if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}