<?php

namespace App\Http\Controllers;

use App\Models\Warsha;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\Validator;

class WarshaController extends Controller
{
    use ApiTrait;

    public function GetAllWarsha(){

        $warshas = Warsha::all();
        return $this->Data(compact('warshas'),"",200);
    }

    public function GetWarshaInfo(Request $request ,$id){
        
        $warshas = Warsha::find($id);
        if ($warshas){
            return $this->Data(compact('warshas'),"",200);
        }
        else {
            return $this->ErrorMessage(['ID' => 'Something Error' ],"ID Not Found",404);
        }
    }
}
