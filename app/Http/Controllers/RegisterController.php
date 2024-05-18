<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    use ApiTrait;

    public function Register(RegisterRequest $request){
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = "Bearer ".$user->createToken($request->email)->plainTextToken;
        return $this->Data(compact('user'),"User Created Successfully",201);

    }

    public function SendCode(Request $request){

        // 1- Get token 
        $token = $request->header('Authorization');
        $authenticated = Auth::guard('sanctum')->user();
        // 2- Gen code 
        $code = rand(1000,9999);
        // 3- Gen expiration date 
        $expiration = date('Y-m-d H:i:s',strtotime('+10 minutes'));
        // 4- Save code and date in db
        $user = User::find($authenticated->id);
        $user->code = $code ;
        $user->code_expired_at = $expiration;
        $user->save();
        $user->token = $token;

        return $this->Data(compact('user'),"",200);
    }

    public function CheckCode(Request $request){

        $request->validate([
            'code' => ['required','digits:4','exists:users,code'],
        ]);
        
        $token = $request->header('Authorization');
        $authenticated = Auth::guard('sanctum')->user();

        $user = User::find($authenticated->id);
        $now =  date('Y-m-d H:i:s');

        if ($user->code == $request->code && $user->code_expired_at > $now){
            $user->email_verified_at = $now ;
            $user->save();
            $user->token = $token;

            return $this->Data(compact('user'),"User Verified Successfully",200);
        }
        else {
            return $this->ErrorMessage(["code"=>"Code Invalid"],"Failed attempt",401);
        }

    }
}
