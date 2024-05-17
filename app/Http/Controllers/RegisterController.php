<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
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
}
