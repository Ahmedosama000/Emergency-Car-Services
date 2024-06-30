<?php

namespace App\Http\Controllers;

use App\Models\Warsha;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Models\Fany;
use App\Models\Wensh;
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

    public function GetAllFany(){

        $fanys = Fany::all();
        return $this->Data(compact('fanys'),"",200);
    }

    public function GetFanyInfo(Request $request ,$id){
        
        $fanys = Fany::find($id);
        if ($fanys){
            return $this->Data(compact('fanys'),"",200);
        }
        else {
            return $this->ErrorMessage(['ID' => 'Something Error' ],"ID Not Found",404);
        }
    }

    public function GetAllWenshs(){

        $wenshs = Wensh::all();
        return $this->Data(compact('wenshs'),"",200);
    }

    public function GetWenshInfo(Request $request ,$id){
        
        $wenshs = Wensh::find($id);
        if ($wenshs){
            return $this->Data(compact('wenshs'),"",200);
        }
        else {
            return $this->ErrorMessage(['ID' => 'Something Error' ],"ID Not Found",404);
        }
    }
}
