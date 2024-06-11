<?php

namespace App\Http\Controllers;

use App\Models\Doctor_Category;
use App\Traits\BaseFunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorCategoryController extends Controller
{
    //
    use BaseFunctionsTrait;

########################## Store Category #######################
    public function Store(Request $request){
        $validate = Validator::make($request->all(), [
            'Title' => 'required|string',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        Doctor_Category::create([
            'Title'=>$request->Title,
        ]);
        return $this->handelResponse('','The Category has been added successfully');
    }
########################## Get All Categories #######################

    public function Get_All_Categories(){
        return $this->Get(Doctor_Category::class);
    }
########################## Delete Category #######################

    public function Update(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:doctor_categories,id',
            'Title' => 'required|string',

        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        Doctor_Category::find($request->id)->Update([
            'Title'=>$request->Title,

        ]);
        return $this->handelResponse('','The Category has been Updated successfully');

    }



########################## Delete Category #######################

    public function Delete(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:doctor_categories,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        Doctor_Category::find($request->id)->delete();
        return $this->handelResponse('','The Category has been Deleted successfully');

    }

}
