<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserLoginResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $user = User::create($input);
        return $this->sendResponse(new UserResource($user), 'Registered complete, please check your email to verify your account',201);
    }
   

    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            /** @var \App\Models\User $user **/
            $user = Auth::user(); 
            return $this->sendResponse(new UserLoginResource($user), 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorized.', ['error'=>'Unauthorized']);
        } 
    }
}
