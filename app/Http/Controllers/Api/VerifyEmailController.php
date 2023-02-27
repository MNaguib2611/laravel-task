<?php

namespace App\Http\Controllers\Api;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class VerifyEmailController extends Controller
{


    /* Note: typically the user should be redirected to frontend */ 
    /* Sent json responses to the user */ 

    public function verifyEmail(Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response()->json(["message" => "User already verified"]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(["message" => "User verified successfully"]);
    }



    public function resendVerificationEmail (Request $request){
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(["message" => "User already verified"]);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json(["message" => 'Verification link sent!']);

    }



    public function hasVerifiedEmail(Request $request)
    {
        return response()->json(["verified_email"=> $request->user()->hasVerifiedEmail()]);
    }
     
}
