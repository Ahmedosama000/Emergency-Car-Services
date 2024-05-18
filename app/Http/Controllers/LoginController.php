<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Auth\Events\Login;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiTrait;

    public function Login (LoginRequest $request){

        $user = User::where('email',$request->email)->first();
        if (! Hash::check($request->password,$user->password)){
            return $this->ErrorMessage(["email"=>"The email or password not correct"],"",401);
        }
        $user->token = "Bearer ".$user->createToken($request->password)->plainTextToken;
        if (is_null($user->email_verified_at)){
            return $this->Data(compact('user'),"User Not Verified",401);
        }
        return $this->Data(compact('user'),"",200);
    }

    public function Logout(Request $request){
        
        $token = $request->header('Authorization');
        $authenticated = Auth::guard('sanctum')->user();

        $IdWithBearer = explode('|',$token)[0];
        $TokenId = explode(' ',$IdWithBearer)[1];

        $authenticated->tokens()->where('id',$TokenId)->delete();
        return $this->SuccessMessage("User logged out Successfully",200);

    }
    
}
